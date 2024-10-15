@extends('admin.master_layout')
@section('title')
    <title>{{ __('Create Team') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Create Team') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Our Team') => route('admin.ourteam.index'),
                __('Create Team') => '#',
            ]" />

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Create Team')" />
                                <div>
                                    <x-admin.back-button :href="route('admin.ourteam.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.ourteam.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <x-admin.form-image-preview label="Avatar Image" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="name" name="name" label="{{ __('Name') }}"
                                                placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}"
                                                required="true" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-input id="designation" name="designation"
                                                label="{{ __('Designation') }}" placeholder="{{ __('Enter Designation') }}"
                                                value="{{ old('designation') }}" required="true" />
                                        </div>

                                        <div class="form-group col-12">
                                            <x-admin.form-switch name="status" label="{{ __('Status') }}"
                                                active_value="active" inactive_value="inactive" :checked="old('status') == 'active'" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
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
        $.uploadPreview({
            input_field: "#image-upload",
            preview_box: "#image-preview",
            label_field: "#image-label",
            label_default: "{{ __('Choose Image') }}",
            label_selected: "{{ __('Change Image') }}",
            no_label: false,
            success_callback: null
        });
    </script>
@endpush
