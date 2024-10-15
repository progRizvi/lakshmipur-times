@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit Video') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Edit Video') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Videos') => route('admin.video.index'),
                __('Edit Video') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Edit Video')" />
                                <div>
                                    <x-admin.back-button :href="route('admin.video.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.video.update', $video->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-admin.form-input id="link" name="link"
                                                    label="{{ __('Link') }}" placeholder="{{ __('Enter link') }}"
                                                    value="{{ $video->link }}" required="true" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-admin.form-switch id="status" name="status"
                                                    label="{{ __('Status') }}" required="true" :checked="$video->status == 1" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <x-admin.update-button :text="__('Update')" />
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
