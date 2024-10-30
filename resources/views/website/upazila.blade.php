@extends('website.layout.layout')

@section('content')
    <section class="px-4 py-2">
        <div class="container mx-auto">
            <div class="zilla_news_section py-10">
                <div>
                    <h1 class="pages_header">{{ $title }}</h1>
                </div>

                <div class="mb-10">
                    <ul class="bg-orange-100 py-3 flex max-[640px]:flex-wrap items-center justify-center gap-5 rounded-md">

                        @foreach ($upazilas as $up)
                            <li>
                                <a class="button_style text-sm px-4 py-2"
                                    href="{{ route('upazila') }}?thana={{ $up->name }}">{{ $up->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- news cards start -->
                <div>
                    <div class="grid grid-cols-3 max-[1024px]:grid-cols-2 max-[600px]:grid-cols-1 items-start justify-between gap-5"
                        id="news-container">
                        @include('components.news-pagination')
                    </div>

                    @if (!($news->count() > 0))
                        <div class="text-center mt-5">
                            <h1 class="text-3xl font-bold">কোন খবর নেই</h1>
                        </div>
                    @endif
                    @if ($news->nextPageUrl())
                        <div class="text-center mt-5">
                            <button class="px-5 py-2 button_style" id="load-more">আরও ≫</button>
                        </div>
                    @endif
                </div>
                <!-- news cards end -->
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            let page = 1;

            $('#load-more').click(function() {
                page++;
                loadMoreData(page);
            });

            function loadMoreData(page) {

                const query = window.location.search;
                const urlParams = new URLSearchParams(query);
                const thana = urlParams.get('thana');
                $.ajax({
                        url: '?page=' + page + '&thana=' + thana,
                        type: "get",
                        beforeSend: function() {
                            $('#load-more').text('লোড হচ্ছে...');
                        }
                    })
                    .done(function(data) {
                        if (!data) {
                            $('#load-more').text('আর কোন খবর নেই');
                            return;
                        }
                        $('#load-more').html('আরও &raquo;');
                        $('#news-container').append(data);
                    })
                    .fail(function() {
                        alert('কিছু সমস্যা হয়েছে, দয়া করে আবার চেষ্টা করুন।');
                    });
            }
        });
    </script>
@endpush
