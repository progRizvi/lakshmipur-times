@extends('admin.master_layout')
@section('title')
    <title>{{ __('Add Video') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Add Video') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Videos') => route('admin.video.index'),
                __('Add Video') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Add Video')" />
                                <div>
                                    <x-admin.back-button :href="route('admin.video.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.video.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-admin.form-input id="link" name="link"
                                                    label="{{ __('Link') }}" placeholder="{{ __('Enter link') }}"
                                                    value="{{ old('link') }}" required="true" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-admin.form-switch id="status" name="status"
                                                    label="{{ __('Status') }}" value="{{ old('status') }}" required="true"
                                                    checked />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <x-admin.save-button :text="__('Save')" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
