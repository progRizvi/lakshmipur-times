@extends('admin.master_layout')
@section('title')
    <title>{{ __('Manage Admin') }}</title>
@endsection
@section('admin-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Manage Admin') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Settings') => route('admin.settings'),
                __('Manage Admin') => '#',
            ]" />

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Manage Admin')" />
                                <div>
                                    @adminCan('admin.create')
                                        <x-admin.add-button :href="route('admin.admin.create')" />
                                    @endadminCan
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Roles') }}</th>
                                                @adminCan('admin.edit')
                                                    <th>{{ __('Status') }}</th>
                                                @endadminCan
                                                @adminCan('admin.delete')
                                                    <th>{{ __('Action') }}</th>
                                                @endadminCan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($admins as $index => $admin)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        {{ $admin->getRoleNames() }}
                                                    </td>
                                                    @adminCan('admin.edit')
                                                        <td>
                                                            @if ($admin->status == 'active')
                                                                <a href="javascript:;"
                                                                    onclick="changeAdminStatus({{ $admin->id }})">
                                                                    <input id="status_toggle" type="checkbox" checked
                                                                        data-toggle="toggle" data-onlabel="{{ __('Active') }}"
                                                                        data-offlabel="{{ __('Inactive') }}"
                                                                        data-onstyle="success" data-offstyle="danger">
                                                                </a>
                                                            @else
                                                                <a href="javascript:;"
                                                                    onclick="changeAdminStatus({{ $admin->id }})">
                                                                    <input id="status_toggle" type="checkbox"
                                                                        data-toggle="toggle" data-onlabel="{{ __('Active') }}"
                                                                        data-offlabel="{{ __('Inactive') }}"
                                                                        data-onstyle="success" data-offstyle="danger">
                                                                </a>
                                                            @endif
                                                        </td>
                                                    @endadminCan
                                                    @adminCan('admin.delete')
                                                        <td>
                                                            @adminCan('admin.edit')
                                                                <x-admin.edit-button :href="route('admin.admin.edit', $admin->id)" />
                                                            @endadminCan
                                                            @adminCan('admin.delete')
                                                                <x-admin.delete-button :id="$admin->id" onclick="deleteData" />
                                                            @endadminCan
                                                        </td>
                                                    @endadminCan
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Admin')" route="admin.admin.create" create="yes"
                                                    :message="__('No data found!')" colspan="6" />
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        {{ $admins->links() }}
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
        function deleteData(id) {
            $("#deleteForm").attr("action", "{{ url('admin/admin/') }}" + "/" + id)
        }

        function changeAdminStatus(id) {
            $.ajax({
                type: "put",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                url: "{{ url('/admin/admin-status/') }}" + "/" + id,
                success: function(response) {
                    toastr.success(response.message)
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }
    </script>
@endpush
