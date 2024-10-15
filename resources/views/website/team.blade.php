@extends('website.layout.layout')

@section('content')
    <section class="px-4 py-5">
        <div class="container mx-auto">
            <div class="team_section">
                <!-- team header start -->
                <div>
                    <h1 class="pages_header text-center">আমরা</h1>
                </div>
                <!-- team header end -->

                <!-- CEO -->
                @foreach ($teams as $team)
                    @if ($loop->first)
                        <div class="mb-10 flex flex-wrap items-start justify-center gap-5">
                            <div class="our_team_card_wrapper group relative">
                                <div>
                                    <img class="our_team_images" src="{{ asset($team->image) }}" alt="images" />
                                </div>
                                <div class="our_team_titles">
                                    <h3>{{ $team->name }}</h3>
                                    <p>{{ $team->designation }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="mb-10 grid grid-cols-2 gap-5">
                    @foreach ($teams as $index => $team)
                        @if ($index == 0)
                            @continue
                        @endif
                        <div class="our_team_card_wrapper group relative">
                            <div>
                                <img class="our_team_images" src="{{ asset($team->image) }}" alt="{{ $team->name }}" />
                            </div>
                            <div class="our_team_titles">
                                <h3>{{ $team->name }}</h3>
                                <p>{{ $team->designation }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
