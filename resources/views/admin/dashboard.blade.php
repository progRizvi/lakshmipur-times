@extends('admin.master_layout')
@section('title')
    <title>{{ __('Dashboard') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">

        <section class="section">
            <x-admin.breadcrumb title="{{ __('Dashboard') }}" />

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total News') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $data['totalNews'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-info">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{ __('Total Team Members') }}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $data['teamMembers'] }}
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Recent Orders') }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.news.index') }}"
                                        class="btn btn-primary">{{ __('View All') }}</a>
                                </div>
                            </div>

                            <div class="p-0 card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Reporter') }}</th>
                                                <th>{{ __('Thana') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data['recentNews'] as $news)
                                                <tr>
                                                    <td><a href="{{ route('news.details', $news->slug) }}"
                                                            target="_blank">{{ $news->title }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $news->reporter }}
                                                    </td>
                                                    <td>{{ $news->city?->name }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">{{ __('No data found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
