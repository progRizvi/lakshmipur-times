<div class="news_card">
    <a href='{{ route('news.details', $post->slug) }}'>
        <div class="shadow-sm shadow-[#ff5f15] rounded-lg overflow-hidden">
            <div class="mb-3">
                <img class="w-full h-[300px]" src="{{ asset($post->image) }}" alt="{{ $post->title }}" />
            </div>
            <div class="px-3 pb-3">
                <div class="flex items-center justify-between gap-3 mb-2">
                    <p>{{ $post->reporter }}</p>
                    <p>{{ $post->city?->name }}</p>
                </div>

                <div>
                    <h2 class="text-lg font-bold mb-2">
                        {{ $post->title }}
                    </h2>
                    <p class="text-sm truncate">
                        {!! Str::limit($post->short_description, 100) !!}
                    </p>
                    <p class="text-right">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
