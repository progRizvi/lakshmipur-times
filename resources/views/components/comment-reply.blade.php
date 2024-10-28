{{-- @foreach ($replies as $reply)
    <div class="flex items-start gap-2">
        <img class="w-8 h-8 rounded-full" src="{{ asset($setting->default_avatar) }}" alt="User Avatar" />
        <div class="flex-1 bg-gray-200 p-3 rounded-lg">
            <div
                class="flex max-[500px]:flex-col justify-between items-center max-[500px]:justify-start max-[500px]:items-start">
                <h4 class="text-xs font-semibold">{{ $reply->name }}</h4>
                <span class="text-xs text-gray-500">
                    {{ $reply->created_at->diffForHumans() }}
                </span>
            </div>
            <p class="mt-1 text-gray-700 max-[500px]:text-sm">
                {{ $reply->comment }}
            </p>
        </div>
        <div class="mt-4">
            <a href="#blogCommentForm" data-id="{{ $reply->id }}" class="reply">
                <span><i class="fas fa-share"></i></span>
                {{ __('Reply') }}</a>
        </div>
        @if ($reply->children->count() > 0)
            @include('components.comment-reply', ['replies' => $reply->children])
        @endif
    </div>
@endforeach --}}


@foreach ($replies as $reply)
    <!-- Reply Item -->
    <div class="flex items-start gap-2">
        <img class="w-8 h-8 rounded-full" src="{{ asset($setting->default_avatar) }}" alt="{{ $reply->name }}" />
        <div class="flex-1 bg-gray-200 p-3 max-[500px]:p-2 rounded-lg">
            <div
                class="flex max-[500px]:flex-col justify-between items-center max-[500px]:justify-start max-[500px]:items-start">
                <h4 class="text-xs font-semibold">{{ $reply->name }}</h4>
                <span class="text-xs text-gray-500">
                    {{ $reply->created_at->diffForHumans() }}
                </span>
            </div>
            <p class="mt-1 text-gray-700 max-[500px]:text-sm">
                {{ $reply->comment }}
            </p>
            <div class="flex justify-end">
                <a href="#blogCommentForm" data-id="{{ $reply->id }}"
                    class="text-sm px-3 py-1 bg-gray-500 text-white font-semibold rounded-md shadow-md hover:bg-gray-600 transition reply">
                    <span><i class="fas fa-share"></i></span>
                    {{ __('Reply') }}</a>
            </div>

            <!-- reply to reply start -->
            <!-- 1 -->
            @if ($reply->children->count() > 0)
                <div class="mt-4">
                    @include('components.comment-reply', ['replies' => $reply->children])
                </div>
            @endif
        </div>
    </div>
@endforeach
