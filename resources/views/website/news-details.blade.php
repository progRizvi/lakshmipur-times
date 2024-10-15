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
                        <form action="">
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
                                <div class="w-full">
                                    <input
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        type="number" name="number" id="number" placeholder="Enter Your Number" />
                                </div>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-4">Leave a Comment</h2>
                                <div class="space-y-4">
                                    <textarea
                                        class="w-full h-24 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                        placeholder="Write your comment here..."></textarea>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-4 py-2 button_style">
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Comment list -->
                        <div class="space-y-6">
                            <!-- Comment Item -->
                            <div class="flex items-start space-x-4">
                                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/50"
                                    alt="User Avatar" />
                                <div class="flex-1 bg-gray-100 p-3 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-semibold">John Doe</h3>
                                        <span class="text-xs text-gray-500">2 hours ago</span>
                                    </div>
                                    <p class="mt-2 text-gray-700 max-[500px]:text-sm">
                                        This is a sample comment. Nice feature you've built
                                        here!
                                    </p>

                                    <!-- Reply form -->
                                    <div class="mt-4">
                                        <h4 class="text-sm font-semibold mb-2">Reply</h4>
                                        <form class="space-y-2">
                                            <textarea
                                                class="w-full h-16 p-2 resize-none border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                placeholder="Write your reply here..."></textarea>
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="px-3 py-1 bg-gray-500 text-white font-semibold rounded-md shadow-md hover:bg-gray-600 transition">
                                                    Post Reply
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Another Comment Item -->
                            <div class="flex items-start space-x-4">
                                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/50"
                                    alt="User Avatar" />
                                <div class="flex-1 bg-gray-100 p-3 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-sm font-semibold">Jane Smith</h3>
                                        <span class="text-xs text-gray-500">1 day ago</span>
                                    </div>
                                    <p class="mt-2 text-gray-700 max-[500px]:text-sm">
                                        I really like this feature! Looking forward to using it
                                        more.
                                    </p>

                                    <!-- Replies Section -->
                                    <div class="mt-4 space-y-4">
                                        <!-- Reply Item -->
                                        <div class="flex items-start gap-2">
                                            <img class="w-8 h-8 rounded-full" src="https://via.placeholder.com/40"
                                                alt="User Avatar" />
                                            <div class="flex-1 bg-gray-200 p-3 rounded-lg">
                                                <div
                                                    class="flex max-[500px]:flex-col justify-between items-center max-[500px]:justify-start max-[500px]:items-start">
                                                    <h4 class="text-xs font-semibold">Michael Lee</h4>
                                                    <span class="text-xs text-gray-500">
                                                        5 hours ago
                                                    </span>
                                                </div>
                                                <p class="mt-1 text-gray-700 max-[500px]:text-sm">
                                                    I agree with you! It's a useful feature.
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Reply form -->
                                        <div>
                                            <h4 class="text-sm font-semibold mb-2">Reply</h4>
                                            <form class="space-y-2">
                                                <textarea
                                                    class="w-full h-16 p-2 resize-none border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    placeholder="Write your reply here..."></textarea>
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-gray-500 text-white font-semibold rounded-md shadow-md hover:bg-gray-600 transition">
                                                        Post Reply
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- comment section end -->
                </div>
                <!-- detais end -->
            </div>
        </div>
    </section>
@endsection
