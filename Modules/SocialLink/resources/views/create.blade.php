@extends('admin.master_layout')
@section('title')
    <title>{{ __('Add Social Link') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Add Social Link') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Social Links') => route('admin.social-link.index'),
                __('Add Social Link') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Add Social Link')" />
                                <div>
                                    <x-admin.back-button :href="route('admin.social-link.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.social-link.store') }}" method="post"
                                    enctype="multipart/form-data">
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
                                                <x-admin.form-input id="icon" name="icon"
                                                    label="{{ __('Icon') }}" placeholder="{{ __('Enter Icon') }}"
                                                    value="{{ old('icon') }}" required="true"
                                                    class="custom-icon-picker" />
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

@push('js')
    <script src="{{ asset('backend/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
        'use strict';
        $(function() {
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "{{ __('Choose Icon') }}",
                label_selected: "{{ __('Change Icon') }}",
                no_label: false,
                success_callback: null
            });
        });
    </script>
@endpush
