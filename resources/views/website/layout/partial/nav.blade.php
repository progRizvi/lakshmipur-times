@php
    if (cache()->has('nav_menu')) {
        $mainMenu = cache('nav_menu');
    } else {
        $mainMenu = Cache::rememberForever('nav_menu', function () {
            return menuGetBySlug('main-menu');
        });
    }

    $currentPath = request()->path();

    $currentPath = explode('/', $currentPath);
    $currentPath = end($currentPath);

    use App\Models\Advertise;
    $topAd = Advertise::where('position', 'top')->first();
@endphp


<header class="primary_bg_color shadow-[0_4px_30px_#0000001a] backdrop-blur-[5px]">
    <div>
        <div class="header_section">
            <!-- header top Logo & addvertisement start -->
            <div class="h-28 max-[768px]:h-20 px-5 py-2 flex items-center justify-between gap-5 container mx-auto">
                <!-- Logo is here -->
                <div class="h-full">
                    <div class="h-3/4">
                        <a href="{{ route('home') }}">
                            <img class="h-full" src="{{ asset($setting->logo) }}" alt="" />
                        </a>
                    </div>
                    @php
                        use App\Helpers\BenglaCalender;

                        // Example: English date to be converted
                        $navDate = \Carbon\Carbon::now()->format('d F, Y');
                        $navDate = BenglaCalender::bn_date_time($navDate);
                    @endphp
                    <h1 class="py-1 max-[768px]:text-xs text-white">
                        {{ $navDate }}
                    </h1>
                </div>

                <!-- Advertisement -->
                <div class="h-full">
                    <a href="{{ $topAd?->link }}">
                        <img class="h-full print:hidden" src="{{ asset($topAd?->image) }}" alt="" />
                    </a>
                </div>
            </div>
            <!-- header top Logo & addvertisement end -->

            <div class="print:hidden">
                <!--  -->
                <!-- Menu items start -->
                <div class="bg-slate-800 px-5 py-2">
                    <div class="container mx-auto">
                        <div class="relative">
                            <ul class="flex items-center justify-around [&>li]:py-2">
                                @foreach ($mainMenu as $menu)
                                    @php
                                        $currLink = explode('/', $menu['link']);
                                        $currLink = end($currLink);
                                        $isActive = $currLink === $currentPath;
                                        $link = $menu['link'];
                                    @endphp
                                    @if (count($menu['child']))
                                        <li class="mega_menu_wrapper">
                                            <button id="toggle_menu_btn"
                                                class="inline-block h-full text-white hover:primary_text_color hover:underline">
                                                আরও
                                            </button>

                                            <!-- megamenu start -->
                                            <div id="toggle_menu_items"
                                                class="w-full bg-slate-800 text-white hidden absolute top-full right-0 z-10">
                                                <ul
                                                    class="grid grid-cols-5 max-[768px]:grid-cols-3 items-center gap-3 justify-between p-3 max-[768px]:text-base">
                                                    @foreach ($menu['child'] as $child)
                                                        @php
                                                            $childLink = last(explode('/', $child['link']));
                                                            $isChildActive = $childLink === $currentPath;
                                                        @endphp
                                                        <li
                                                            class="px-4 py-1 hover:bg-gray-100 hover:primary_text_color">
                                                            <a class="inline-block w-full" href="{{ $child['link'] }}">
                                                                {{ $child['label'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- megamenu end -->
                                        </li>
                                    @else
                                        <li class="max-[768px]:hidden">
                                            <a class="text-white hover:primary_text_color hover:underline {{ $isActive ? 'active' : '' }}"
                                                aria-current="page" href="{{ $link }}">{{ $menu['label'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Menu items end -->

                <!-- search dropdown start -->
                <div class="bg-gray-200 text-gray-700 py-4">
                    <form action="{{ route('search') }}">
                        <div class="container mx-auto flex justify-end items-center space-x-4 gap-5 px-4">
                            <div class="w-full flex items-center gap-5">
                                <input type="text" name="search" id="search" placeholder="অনুসন্ধান করুন"
                                    class="w-full px-3 py-[6px] border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                <button class="py-[5px] px-4 button_style rounded" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            @php

                                $districts = App\Models\State::get();
                                $thanas = App\Models\City::get();
                            @endphp


                            <div class="flex items-center gap-5 max-[768px]:hidden">
                                <!-- First Dropdown -->
                                <div class="flex space-x-2 items-center">
                                    <label for="district" class="text-gray-800">জেলা</label>
                                    <select id="district" name="district"
                                        class="border border-gray-400 rounded py-1 px-2">
                                        <option disabled selected value="1">জেলা</option>
                                        @foreach ($districts as $dis)
                                            <option value="{{ $dis->name }}">{{ $dis->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="py-[5px] px-4 button_style rounded" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                <!-- Second Dropdown -->
                                <div class="flex space-x-2 items-center">
                                    <label for="subdistrict" class="text-gray-800">
                                        উপজেলা
                                    </label>
                                    <select id="subdistrict" name="thana"
                                        class="border border-gray-400 rounded py-1 px-2">
                                        <option disabled selected value="1">উপজেলা</option>
                                        @foreach ($thanas as $thana)
                                            <option value="{{ $thana->name }}">{{ $thana->name }}</option>
                                        @endforeach
                                    </select>
                                    <button class="py-[5px] px-4 button_style rounded" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!--  -->
                        </div>
                    </form>
                </div>
                <!-- search dropdown end -->

                @php
                    $news = Modules\Blog\app\Models\News::orderBy('id', 'desc')
                        ->where('status', 1)
                        ->where('news_ticker', 1)
                        ->take(5)
                        ->get();
                @endphp


                <!-- Scrolling Text start -->
                <div class="bg-gray-100 py-2">
                    <div class="container mx-auto">
                        <marquee class="text-gray-700 text-sm" onmouseover="this.stop()" onmouseout="this.start()">
                            <ul class="flex items-center gap-10">
                                @foreach ($news as $post)
                                    <li class="list-disc">
                                        <a href="{{ route('news.details', $post->slug) }}"
                                            class="hover:text-[#ff5f15]">
                                            {{ $post->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </marquee>
                    </div>
                </div>
                <!-- Scrolling Text end -->
                <!--  -->
            </div>
        </div>
    </div>
</header>
