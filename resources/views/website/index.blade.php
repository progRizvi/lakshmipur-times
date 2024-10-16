@extends('website.layout.layout')

@section('content')
    <!-- Hero section start -->
    <section class="py-10 overflow-hidden">
        <div class="container mx-auto">
            <div class="hero_section p-3">
                <div class="flex items-center justify-between gap-4">
                    <div class="w-full">
                        <!-- Newses start -->
                        <div>
                            <h1 class="text-2xl font-bold mb-10 underline underline-offset-8 decoration-dotted">
                                সর্বশেষ
                            </h1>
                        </div>
                        <!-- top news -->
                        <div>

                            <a href="{{ route('news.details', $mostLatestNews->slug) }}"
                                class="flex max-[768px]:flex-col-reverse items-start justify-between gap-4 hover:[&>div>img]:scale-110 news_card_hover">
                                <div class="w-1/2 max-[768px]:w-full">
                                    <h1
                                        class="text-3xl max-[768px]:text-xl max-[768px]:font-bold leading-[46px] mb-3 transition-all duration-300">
                                        {{ $mostLatestNews->title }}
                                    </h1>
                                    <p class="text-lg max-[768px]:text-base leading-7 truncate">
                                        {!! Str::limit($mostLatestNews->short_description, 100) !!}
                                    </p>
                                </div>
                                <div class="w-1/2 max-[768px]:w-full overflow-hidden">
                                    <img class="w-full transition-all duration-500"
                                        src="{{ asset($mostLatestNews->image) }}" alt="{{ $mostLatestNews->title }}" />
                                </div>
                            </a>
                        </div>
                        <hr class="my-5 h-[2px] bg-gray-300" />

                        <!-- top news - 2 -->
                        <div class="flex max-[768px]:flex-col items-start justify-between gap-3">
                            <!-- 1 -->
                            @foreach ($secondMost as $post)
                                <div class="{{ $secondMost->count() == 2 && 'border-r-2 border-gray-300' }} pr-2">
                                    <a href="{{ route('news.details', $post->slug) }}"
                                        class="flex items-start justify-between gap-4 news_card_hover">
                                        <div class="w-1/2">
                                            <h1 class="text-sm mb-2 font-bold">
                                                {{ $post->title }}
                                            </h1>
                                            <p class="text-xs font-semibold max-[768px]:font-normal leading-5">
                                                {!! Str::limit($post->short_description, 100) !!}
                                            </p>
                                        </div>
                                        <div class="w-1/2 h-full">
                                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" />
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-5 h-[2px] bg-gray-300" />

                        <!-- All news -->
                        <div class="grid grid-cols-3 max-[768px]:grid-cols-1 items-start justify-between gap-2">
                            <!-- 1 -->
                            @foreach ($newses as $news)
                                <div class="border-r-2 border-gray-300 pr-2">
                                    <a href="{{ route('news.details', $news->slug) }}"
                                        class="flex items-start justify-between gap-4 news_card_hover">
                                        <div class="w-1/2">
                                            <h1 class="text-sm mb-2 font-bold">
                                                {{ $news->title }}
                                            </h1>
                                        </div>
                                        <div class="w-1/2 h-full">
                                            <img class="w-full" src="{{ asset($news->image) }}"
                                                alt="{{ $news->title }}" />
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <hr class="my-5 h-[2px] bg-gray-300" />

                        <!-- advertisement start -->
                        <div class="w-full mx-auto">
                            <a href="#">
                                <img class="w-full h-auto" src="/src/images/banner.jpg" alt="বিজ্ঞাপণ" />
                                <p class="text-center mt-1">Advertisement</p>
                            </a>
                        </div>
                        <!-- advertisement end -->
                        <!-- Newses end -->
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </section>
    <!-- Hero section end -->

    <!-- youtube video section start -->
    <section class="px-4 py-5 mb-3">
        <div class="container mx-auto">
            <div class="hero_section overflow-hidden">
                <div>
                    <div>
                        <h1
                            class="text-center text-3xl max-[768px]:text-2xl py-2 mb-5 underline underline-offset-8 decoration-dotted">
                            লক্ষ্মীপুর টাইমস ভিডিও
                        </h1>
                    </div>
                    <!-- videos start -->
                    <div>
                        <div class="grid grid-cols-3 max-[768px]:grid-cols-1 items-start justify-between gap-5">
                            <!-- 1 -->
                            @foreach ($videos as $video)
                                @php
                                    $videoId = explode('v=', $video->link)[1];
                                @endphp
                                <div class="w-full">
                                    <iframe width="100%" height="300"
                                        src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            @endforeach
                            <!-- 2 -->
                        </div>
                        <!-- more button start -->
                        <div class="text-center mt-5">
                            <button class="px-5 py-2 button_style">আরও ≫</button>
                        </div>
                        <!-- more button end -->
                    </div>
                    <!-- videos end -->

                    <!-- advertisement start -->
                    <div class="flex items-center justify-center gap-5 mt-4">
                        <div class="h-auto">
                            <a href="#">
                                <img class="h-auto w-full" src="/src/images/banner.jpg" alt="advertisement" />
                            </a>
                        </div>
                        <div class="h-auto">
                            <a href="#">
                                <img class="h-auto w-full" src="/src/images/banner.jpg" alt="advertisement" />
                            </a>
                        </div>
                    </div>
                    <!-- advertisement end -->
                </div>
            </div>
        </div>
    </section>
    <!-- youtube video section end -->
@endsection
