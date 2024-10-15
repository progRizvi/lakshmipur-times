@extends('admin.master_layout')
@section('title')
    <title>{{ __('Edit News') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Edit News') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('News List') => route('admin.news.index'),
                __('Edit News') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Edit News')" />
                                <div>
                                    <x-admin.back-button :href="route('admin.news.index')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <form
                                    action="{{ route('admin.news.update', [
                                        'news' => $news->id,
                                    ]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <x-admin.form-input id="title" data-translate="true" name="title"
                                                label="{{ __('Title') }}" placeholder="{{ __('Enter Title') }}"
                                                value="{{ $news->title }}" required="true" />
                                        </div>

                                        <div class="form-group col-md-8">
                                            <x-admin.form-input id="slug" name="slug" label="{{ __('Slug') }}"
                                                placeholder="{{ __('Enter Slug') }}" value="{{ $news->slug }}"
                                                required="true" />
                                        </div>

                                        <div class="form-group col-md-4">
                                            <x-admin.form-select name="category_id[]" id="category_id" class="select2"
                                                multiple label="{{ __('Categories') }} " required="true">
                                                <x-admin.select-option value="" text="{{ __('Select Category') }}" />
                                                @foreach ($categories as $category)
                                                    <x-admin.select-option :selected="in_array($category->id, $selectedCategories)" value="{{ $category->id }}"
                                                        text="{{ $category->title }}" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-editor id="short_description" name="short_description"
                                                label="{{ __('Short Description') }}" value="{!! $news->short_description !!}"
                                                required="true" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-editor id="description" name="description"
                                                label="{{ __('Description') }}" value="{!! $news->description !!}"
                                                required="true" />
                                        </div>

                                        <div class="form-group col-md-3">
                                            <x-admin.form-switch name="show_homepage" label="{{ __('Show on homepage') }}"
                                                :checked="$news->show_homepage == 1" />
                                        </div>

                                        <div class="form-group col-md-3">
                                            <x-admin.form-switch name="is_popular" label="{{ __('Mark as a Popular') }}"
                                                :checked="$news->is_popular == 1" />
                                        </div>

                                        <div class="form-group col-md-2">
                                            <x-admin.form-switch name="status" label="{{ __('Status') }}"
                                                :checked="$news->status == 1" />
                                        </div>

                                        <div class="form-group col-md-2">
                                            <x-admin.form-switch name="latest" label="{{ __('Latest') }}"
                                                :checked="$news->latest == 1" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <x-admin.form-switch name="news_ticker" label="{{ __('News Ticker') }}"
                                                :checked="$news->news_ticker == 1" />
                                        </div>

                                        <div class="form-group col-md-4">
                                            <x-admin.form-input id="date" name="date" label="{{ __('Date') }}"
                                                value="{{ $news->date }}" class="datetimepicker_mask" required="true" />
                                        </div>
                                        <div class="form-group col-md-4">
                                            <x-admin.form-input id="reporter" name="reporter" label="{{ __('Reporter') }}"
                                                value="{{ $news->reporter }}" required="true" />
                                        </div>

                                        <div class="form-group col-md-4">
                                            <x-admin.form-select name="state_id" id="state_id" class="select2"
                                                label="{{ __('District') }} " required="true">
                                                <x-admin.select-option value="" text="{{ __('Select District') }}" />
                                                @foreach ($states as $index => $state)
                                                    <x-admin.select-option :selected="$state->id == $news->state_id" value="{{ $state->id }}"
                                                        text="{{ $state->name }}" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <x-admin.form-select name="city_id" id="city_id" class="select2"
                                                label="{{ __('District') }} " required="true">
                                                <x-admin.select-option value="" text="{{ __('Select Thana') }}" />
                                                @foreach ($cities as $city)
                                                    <x-admin.select-option :selected="$city->id == $news->city_id" value="{{ $city->id }}"
                                                        text="{{ $city->name }}" />
                                                @endforeach
                                            </x-admin.form-select>
                                        </div>

                                        <div class="form-group col-md-8">
                                            <x-admin.form-input id="seo_title" name="seo_title"
                                                label="{{ __('SEO Title') }}" placeholder="{{ __('Enter SEO Title') }}"
                                                data-translate="true" value="{{ $news->seo_title }}" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-textarea id="seo_description" name="seo_description"
                                                label="{{ __('SEO Description') }}"
                                                placeholder="{{ __('Enter SEO Description') }}" data-translate="true"
                                                value="{{ $news->seo_description }}" maxlength="2000" />
                                        </div>

                                        <div class="form-group col-md-12">
                                            <x-admin.form-image-preview :image="$news->image" />
                                        </div>


                                    </div>
                                    <div class="row">
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
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $("#title").on("keyup", function(e) {
                    $("#slug").val(convertToSlug($(this).val()));
                })
            });
        })(jQuery);

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    </script>
@endpush
