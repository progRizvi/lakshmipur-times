@foreach ($news as $post)
    @include('components.news-item', ['post' => $post])
@endforeach
