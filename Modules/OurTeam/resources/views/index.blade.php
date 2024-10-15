@extends('admin.master_layout')
@section('title')
    <title>{{ __('Our Team') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <x-admin.breadcrumb title="{{ __('Create Team') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Our Team') => '#',
            ]" />

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <x-admin.form-title :text="__('Our Team')" />
                                <div>
                                    <x-admin.add-button :href="route('admin.ourteam.create')" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('SN') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Designation') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($teams as $index => $team)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $team->name }}</td>
                                                    <td>{{ $team->designation }}</td>
                                                    <td>
                                                        @if ($team->status == 'active')
                                                            <span class="badge bg-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <x-admin.edit-button :href="route('admin.ourteam.edit', $team->id)" />
                                                        <x-admin.delete-button :id="$team->id" onclick="deleteData" />
                                                    </td>
                                                </tr>
                                            @empty
                                                <x-empty-table :name="__('Team')" route="admin.ourteam.create" create="yes"
                                                    :message="__('No data found!')" colspan="5"/>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <x-admin.delete-modal />
    <script>
        "use strict";

        function deleteData(id) {
            $("#deleteForm").attr("action", '{{ url('admin/ourteam/') }}' + "/" + id)
        }
    </script>
@endsection
