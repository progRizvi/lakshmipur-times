<footer class="px-4 pt-5">
    <div class="container mx-auto">
        <div class="footer_section border-t-2 border-[#387478]">
            <!-- First Row: Logo and Editor's Name -->
            <div class="flex max-[768px]:flex-col items-center justify-between gap-5 mb-4">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <img class="h-36" src="{{ asset($setting->logo) }}" alt="{{ $setting->app_name }}" />
                </div>

                <!-- Editor's Name -->
                <div>
                    <span class="text-gray-700 font-bold"> সম্পাদকঃ {{ $setting->editor }} </span>
                </div>
            </div>

            <!-- Second Row: Links and Contact Info -->
            <div class="flex flex-col justify-between items-center pt-4">
                <!-- social media icons start -->
                <div class="flex items-center gap-5 mb-3">
                    @php
                        $socials = Modules\SocialLink\app\Models\SocialLink::where('status', 1)->get();
                    @endphp
                    @foreach ($socials as $social)
                        <div>
                            <a class="social_icon_style" href="{{ $social->link }}">
                                <i class="{{ $social->icon }}"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- social media icons end -->

                @php
                    if (cache()->has('footer_menu')) {
                        $footer = cache('footer_menu');
                    } else {
                        $footer = Cache::rememberForever('footer_menu', function () {
                            return \Modules\CustomMenu\app\Models\Menu::with('items.translation')
                                ->where('slug', 'secondary-menu')
                                ->first();
                        });
                    }
                @endphp
                <!-- Links start -->
                <div
                    class="flex max-[768px]:flex-wrap max-[768px]:justify-center max-[768px]:gap-4 space-x-4 text-sm text-gray-600 mb-3">
                    @foreach ($footer->items as $item)
                        <a href="{{ $item->link }}" class="hover:underline hover:primary_text_color">
                            {{ $item->label }}
                        </a>
                    @endforeach
                </div>

                <!-- Links end -->

                <!-- Contact Info start -->
                <div class="text-sm text-gray-600">
                    <p class="text-center mb-3">
                        {{ $setting->address }}
                    </p>

                    <div
                        class="flex max-[768px]:flex-wrap max-[768px]:justify-center max-[768px]:gap-4 items-center justify-center gap-5">
                        <p class="flex items-center">
                            <span class="mr-2">
                                <i class="fas fa-mobile-alt"></i>
                            </span>
                            <a href="tel:+8801998304701" class="hover:underline hover:primary_text_color">
                                +৮৮০ ১৯৯৮ ৩০৪৭০১
                            </a>
                        </p>
                        <p class="flex items-center">
                            <span class="mr-2">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <a href="https://wa.me/01998304701" class="hover:underline hover:primary_text_color">
                                +৮৮০ ১৯৯৮ ৩০৪৭০১
                            </a>
                        </p>
                        <p class="flex items-center">
                            <span class="mr-2">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <a href="mailto:{{ $setting->email }}" class="hover:underline hover:primary_text_color">
                                {{ $setting->email }}
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Contact Info end -->

                <!-- copyright start -->
                <div class="mt-5 mb-1 py-2 px4 text-center border-t border-[#ff5f15] text-slate-900 w-full">
                    <p>{{ $setting->copyright_text }}</p>
                </div>
                <!-- copyright end -->
            </div>
        </div>
    </div>
</footer>
