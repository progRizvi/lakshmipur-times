@extends('admin.master_layout')
@section('title')
    <title>{{ __('Translate Language') }} ({{ $language->name }})</title>
@endsection

@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Translate Language') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Settings') => route('admin.settings'),
                __('Manage Language') => route('admin.languages.index'),
                __('Translate Language') => '#',
            ]" />

            <div class="section-body">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-3 service_card">{{ __('Language Translations') }}</h5>
                            <div>
                                <a href="{{ route('admin.languages.index') }}" class="btn btn-primary"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                        </div>
                        <hr>
                        <div class="lang_list_top">
                            <ul class="lang_list">
                                @foreach ($languages as $lang)
                                    <li><a href="{{ route('admin.languages.edit-static-languages', $lang->code) }}"><i
                                                class="fas {{ $lang->code !== request('code') ? 'fa-edit' : 'fa-eye' }}"></i>
                                            {{ $lang->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-2 alert alert-danger" role="alert">
                            <p>{{ __('Your editing mode') }} : <b>{{ $language->name }}</b></p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-block">
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-center">
                                        <h4 class="mb-0">{{ __('Edit') }}
                                            {{ ucwords(str_replace(['_', '-'], ' ', request('file'))) }}
                                            {{ __('Language') }}</h4>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <form onchange="$(this).trigger('submit')"
                                            action="{{ route('admin.languages.edit-static-languages', ['code' => request('code'), 'file' => request('file')]) }}"
                                            method="get">

                                            <div class="input-group">
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder="{{ __('Search') }}">
                                                    <x-admin.button type="submit" :text="__('Search')" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                                        <button type="button" id="translateAll" class="btn btn-primary"
                                            data-code="{{ request('code') }}"
                                            data-file="{{ request('file') }}">{{ __('Translate All To ') }}{{ $language->name }}</button>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.languages.update-static-languages', request('code')) }}"
                                    method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        @php($paginateData = [])
                                        @foreach ($data as $index => $value)
                                            <tr>
                                                <td width="50%">{{ $index }}</td>
                                                <td width="50%">
                                                    <input type="text" id="translation-{{ $loop->index + 1 }}"
                                                        class="form-control" name="values[{{ $index }}]"
                                                        value="{{ $value }}">
                                                </td>
                                            </tr>
                                            @php($paginateData[$index] = $value)
                                        @endforeach
                                    </table>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary">{{ __('Update') }}</button>
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
