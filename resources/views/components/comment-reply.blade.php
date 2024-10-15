@foreach ($replies as $reply)
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
@endforeach
