@extends('website.layout.layout')
@section('content')
    <section class="p-5">
        <div class="container mx-auto">
            <div class="details_section">
                <!-- detais start -->
                <div class="py-10">
                    <!-- headline start -->
                    <div class="mb-8">
                        <p class="mb-2">
                            {{ $news->city?->name }}
                        </p>
                        <h1 class="pages_header">
                            {{ $news->title }}
                        </h1>
                    </div>
                    <!-- headline end -->

                    <!-- journalist details and news date and tools start -->
                    <div
                        class="w-2/3 max-[768px]:w-full my-4 flex items-center justify-between gap-5 max-[500px]:flex-col-reverse max-[500px]:justify-start max-[500px]:items-start">
                        <div class="flex items-center gap-3">
                            <div>
                                <img class="w-14 h-14 max-[640px]:w-10 max-[640px]:h-10 rounded-full"
                                    src="{{ asset($news->image) }}" alt="{{ $news->title }}" />
                            </div>

                            @php
                                use App\Helpers\BenglaCalender;

                                // Example: English date to be converted
                                $englishDate = \Carbon\Carbon::parse($news->date)->format('d F Y, h:i A');
                                $banglaDate = BenglaCalender::bn_date_time($englishDate);
                            @endphp
                            <div>
                                <h4 class="mb-2 font-bold">{{ $news->reporter }}</h4>
                                <p>{{ $banglaDate }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <button id="toggle_share_btn" title="Share"
                                    class="py-3 px-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                    <i class="fas fa-share"></i>
                                </button>

                                <!-- share media start -->
                                <div id="toggle_share_items"
                                    class="w-[147px] bg-white p-2 absolute top-full shadow-md rounded-md hidden">
                                    <div class="grid grid-cols-3 items-center justify-between gap-3">
                                        <button title="Share"
                                            class="py-2 px-3 max-[640px]:py-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                            <i class="fas fa-facebook-f"></i>
                                        </button>
                                        <button title="Share"
                                            class="py-2 px-3 max-[640px]:py-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                            <i class="fas fa-instagram"></i>
                                        </button>
                                        <button title="Share"
                                            class="py-2 px-3 max-[640px]:py-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                            <i class="fas fa-whatsapp"></i>
                                        </button>
                                        <button title="Share"
                                            class="py-2 px-3 max-[640px]:py-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                            <i class="fas fa-youtube"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- share media end -->
                            </div>

                            <button title="Print"
                                class="py-3 px-3 button_style max-[640px]:text-xs flex items-center justify-center"
                                onclick="handlePrint()">
                                <i class="fas fa-print"></i>
                            </button>
                            <button title="Copy"
                                class="py-3 px-3 button_style max-[640px]:text-xs flex items-center justify-center">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <!-- journalist details and news date and tools end -->

                    <!-- News image start -->
                    <div class="mb-5">
                        <img class="w-2/3 max-[768px]:w-full" src="{{ asset($news->image) }}" alt="{{ $news->title }}" />
                    </div>
                    <!-- News image end -->

                    <!-- news texts and avertisement start -->
                    <div>
                        {!! $news->description !!}
                    </div>
                    <!-- news texts and avertisement end -->

                    <!-- comment section start -->
                    <div class="mt-10 p-4 w-full bg-white shadow-lg rounded-lg">
                        <!-- Comment form -->
                        <form action="" id="blogCommentForm" method="POST">
                            <input type="hidden" name="news_id" value="{{ $news->id }}">
                            <input type='hidden' name='parent_id' value='0'>
                            <div class="mb-3 flex max-[600px]:flex-col items-center justify-between gap-3">
                                <div class="w-full">
                                    <input required
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        type="text" name="name" id="name" placeholder="Enter Your Name" />
                                </div>
                                <div class="w-full">
                                    <input
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        type="email" name="email" id="email" placeholder="Enter Your E-mail" />
                                </div>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-4">Leave a Comment</h2>
                                <div class="space-y-4">
                                    <textarea
                                        class="w-full h-24 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                        placeholder="Write your comment here..." name="comment"></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-4 py-2 button_style common_btn">
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Comment list -->
                        <div class="space-y-6">
                            <!-- Comment Item -->

                            @php
                                $parentsComment = $news->comments->where('parent_id', 0);
                            @endphp

                            @foreach ($parentsComment as $comment)
                                <div class="flex items-start space-x-4">
                                    <img class="w-10 h-10 rounded-full" src="{{ asset($setting->default_avatar) }}"
                                        alt="User Avatar" />
                                    <div class="flex-1 bg-gray-100 p-3 rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <h3 class="text-sm font-semibold">{{ $comment->name }}</h3>
                                            <span class="text-xs text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="mt-2 text-gray-700 max-[500px]:text-sm">
                                            {{ $comment->comment }}
                                        </p>

                                        <!-- Reply form -->
                                        <div class="mt-4">
                                            <a href="#blogCommentForm" data-id="{{ $comment->id }}" class="reply">
                                                <span><i class="fas fa-share"></i></span>
                                                {{ __('Reply') }}</a>
                                        </div>

                                        <div class="mt-4 space-y-4">
                                            @include('components.comment-reply', [
                                                'replies' => $comment->children,
                                            ])
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- comment section end -->
                </div>
                <!-- detais end -->
            </div>
        </div>
    </section>
@endsection



@push('scripts')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#blogCommentForm").on('submit', function(e) {
                    e.preventDefault();
                    if ($("#g-recaptcha-response").val() === '') {
                        e.preventDefault();
                        @if ($setting->recaptcha_status == 'active')
                            toastr.error("Please complete the recaptcha to submit the form")
                            return;
                        @endif
                    }
                    $.ajax({
                        type: 'POST',
                        data: $('#blogCommentForm').serialize(),
                        url: "{{ route('comment.post') }}",
                        beforeSend: function() {
                            $(".common_btn").attr("disabled", true);
                            $(".common_btn").html(
                                '<i class="fas fa-spinner fa-spin"></i> {{ ' ' . __('Submitting') }}...'
                            );
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message)
                                $("#blogCommentForm").trigger("reset");
                                $(".common_btn").attr("disabled", false);
                                $(".common_btn").html('{{ __('Submit comment') }}');
                            }
                        },
                        error: function(response) {
                            if (response.responseJSON.errors.name) toastr.error(response
                                .responseJSON.errors.name[0])
                            if (response.responseJSON.errors.email) toastr.error(response
                                .responseJSON.errors.email[0])
                            if (response.responseJSON.errors.comment) toastr.error(response
                                .responseJSON.errors.comment[0])

                            if (!response.responseJSON.errors.name || !response.responseJSON
                                .errors.email || !response.responseJSON.errors.comment) {
                                toastr.error(
                                    "{{ __('Please complete the recaptcha to submit the form') }}"
                                )
                            }
                            $(".common_btn").attr("disabled", false);
                            $(".common_btn").html('{{ __('Submit Comment') }}');
                        }
                    });
                })

                $('.reply').on('click', function() {
                    const parentId = $(this).data('id');
                    console.log(parentId);
                    $("[name='parent_id']").val(parentId);
                })
            });
        })(jQuery);
    </script>
@endpush
