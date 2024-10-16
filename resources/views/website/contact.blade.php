@extends('website.layout.layout')

@section('content')
    <section class="px-4 py-10">
        <div class="container mx-auto">
            <div class="contact_info_section">
                <div>
                    <h1 class="pages_header mb-5">যোগাযোগ</h1>
                </div>
                <div
                    class="grid grid-cols-3 max-[768px]:grid-cols-1 items-center justify-between gap-5 border-t-2 border-[#ff5f15] max-[768px]:border-t-0">
                    <!-- 1 -->
                    <div class="h-full py-2 max-[768px]:pl-2 max-[768px]:border-l-2 max-[768px]:border-[#ff5f15]">
                        <!-- 1.1 -->
                        <div class="flex items-center gap-2 mb-3">
                            <div class="contact_icon_style">
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </div>
                            <div>
                                <p class="font-bold">মোবাইল</p>
                                <a href="tel:01998304701">{{ $setting->phone }}</a>
                            </div>
                        </div>
                        <!-- 1.2 -->
                        <div class="flex items-center gap-2">
                            <div class="contact_icon_style">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <p class="font-bold">হোয়াটস অ্যাপ</p>
                                <a href="https://wa.me/{{ $setting->whatsapp }}">{{ $setting->whatsapp }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="h-full border-l-2 border-[#ff5f15] pl-2 py-2">
                        <!-- 2.1 -->
                        <div class="flex items-center gap-2 mb-3">
                            <div class="contact_icon_style">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div>
                                <p class="font-bold">ই-মেইল</p>
                                <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            </div>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="h-full border-l-2 border-[#ff5f15] pl-2 py-2">
                        <!-- 3.1 -->
                        <div class="flex items-center gap-2 mb-3">
                            <div class="contact_icon_style">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="font-bold">ঠিকানা</p>
                                <a>
                                    {{ $setting->address }}
                                </a>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                    <!-- 4 -->
                </div>
                <div></div>
            </div>
        </div>
    </section>

    <!-- location map start -->
    <section class="px-4 py-5">
        <div class="container mx-auto">
            <div class="contact_info_section">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d3674.170494101533!2d90.8321361111413!3d22.9439473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d22.943513799999998!2d90.83389679999999!4m5!1s0x3754b8ae19dcb481%3A0xd51bd6a39a324fd!2sLakshmipur%20Sadar%20Upazila!3m2!1d22.951182499999998!2d90.86751339999999!5e0!3m2!1sen!2sbd!4v1728202105184!5m2!1sen!2sbd"
                    width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection
