@extends('website.layout.layout')

@section('title', $title)

@section('content')
    <section class="py-10">
        <div class="container mx-auto">
            <div class="hero_section p-3">
                <div class="mb-10">
                    <h3 class="pages_header mb-3">{{ $title }}</h3>
                    <p class="text_size_with_responsive">
                        {!! $content !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
