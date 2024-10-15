@extends('website.layout.layout')

@section('content')
    <section class="px-4 py-2">
        <div class="container mx-auto">
            <div class="zilla_news_section py-10">
                <div>
                    <h1 class="pages_header">{{ $title }}</h1>
                </div>
                <!-- news cards start -->
                <div>
                    <div class="grid grid-cols-3 max-[1024px]:grid-cols-2 max-[600px]:grid-cols-1 items-start justify-between gap-5"
                        id="news-container">
                        {{-- @foreach ($news as $post)
                            @include('components.news-item', ['post' => $post])
                        @endforeach --}}
                        @include('components.news-pagination')
                    </div>

                    <div class="text-center mt-5">
                        <button class="px-5 py-2 button_style" id="load-more">আরও ≫</button>
                    </div>
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
                $.ajax({
                        url: '?page=' + page,
                        type: "get",
                        beforeSend: function() {
                            $('#load-more').text('লোড হচ্ছে...');
                        }
                    })
                    .done(function(data) {
                        console.log();
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
