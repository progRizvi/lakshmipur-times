@extends('admin.master_layout')
@section('title')
    <title>{{ __('Customizeable Page List') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Customizeable Page List') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Customizeable Page List') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Customizeable Page List') }}</h4>
                                <div>
                                    <a href="{{ route('admin.custom-pages.create') }}" class="btn btn-primary"><i
                                            class="fa fa-plus"></i> {{ __('Add New') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive max-h-400">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">{{ __('SN') }}</th>
                                                <th width="30%">{{ __('Title') }}</th>
                                                <th width="15%">{{ __('Slug') }}</th>
                                                <th width="15%">{{ __('Status') }}</th>
                                                <th width="15%">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pages as $page)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td><a target="_blank" href="">{{ $page->title }}</a>
                                                    </td>
                                                    <td>{{ request()->getSchemeAndHttpHost() }}/pages/{{ $page->slug }}
                                                    </td>
                                                    <td>
                                                        <input onchange="changeStatus({{ $page->id }})"
                                                            id="status_toggle" type="checkbox"
                                                            {{ $page->status ? 'checked' : '' }} data-toggle="toggle"
                                                            data-on="{{ __('Active') }}" data-off="{{ __('Inactive') }}"
                                                            data-onstyle="success" data-offstyle="danger">
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.custom-pages.edit', ['page' => $page->id, 'code' => getSessionLanguage()]) }}"
                                                                class="btn btn-warning btn-sm me-2"><i class="fa fa-edit"
                                                                    aria-hidden="true"></i></a>
                                                            <a href="javascript:;" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal" class="btn btn-danger btn-sm"
                                                                onclick="deleteData({{ $page->id }})"><i
                                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </div>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Customizeable Page')" route="admin.custom-pages.index"
                                                    create="no" :message="__('No data found!')" colspan="5"></x-empty-table>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $pages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <x-admin.delete-modal />
@endsection

@push('js')
    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('/admin/custom-pages/') }}' + "/" + id)
        }

        function changeStatus(id) {
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                url: "{{ url('/admin/custom-pages/status-update') }}" + "/" + id,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function(err) {
                    console.log(err);

                }
            });
        }
    </script>
@endpush

@push('css')
    <style>
        .dd-custom-css {
            position: absolute;
            will-change: transform;
            top: 0px;
            left: 0px;
            transform: translate3d(0px, -131px, 0px);
        }

        .max-h-400 {
            min-height: 400px;
        }
    </style>
@endpush
