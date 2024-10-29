@extends('admin.master_layout')
@section('title')
    <title>{{ __('Advertise') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            {{-- Breadcrumb --}}
            <x-admin.breadcrumb title="{{ __('Advertise') }}" :list="[
                __('Dashboard') => route('admin.dashboard'),
                __('Advertise') => '#',
            ]" />
            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="section-title mt-0">Top Advertise</div>
                                <form action="{{ route('admin.advertise.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="position" value="top">
                                    <input type="hidden" name="id" value="{{ $topAdvertise?->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{ __('Image') }}</label>
                                                <div id="preview-top" class="image-preview w-100"
                                                    @if (!empty($topAdvertise?->image)) style="background-image: url({{ asset($topAdvertise?->image) }}); background-size: cover; background-position: center center;" @endif>
                                                    <label for="upload-top" id="label-top">{{ __('Image') }}</label>
                                                    <input type="file" name="image" id="upload-top">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.form-input name="link" label="{{ __('Link') }}"
                                                    :value="$topAdvertise?->link" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.form-input name="title" label="{{ __('Title') }}"
                                                    :value="$topAdvertise?->title" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <x-admin.form-switch name="status" label="{{ __('Status') }}"
                                                :value="$topAdvertise?->status" checked="{{ $topAdvertise?->status }}" />
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.save-button />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="section-title mt-0">Single Advertise</div>
                                <form action="{{ route('admin.advertise.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="position" value="single">
                                    <input type="hidden" name="id" value="{{ $singleAdvertise?->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <x-admin.form-image-preview :image="$singleAdvertise?->image" name="image"
                                                    label="{{ __('Advertise Image') }}"
                                                    button_label="{{ __('Update Image') }}" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.form-input name="link" label="{{ __('Link') }}"
                                                    :value="$singleAdvertise?->link" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.form-input name="title" label="{{ __('Title') }}"
                                                    :value="$singleAdvertise?->title" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <x-admin.form-switch name="status" label="{{ __('Status') }}"
                                                :value="$singleAdvertise?->status" checked="{{ $singleAdvertise?->status }}" />
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <x-admin.save-button />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-title mt-0">2 Column Advertise</div>
                                    <form action="{{ route('admin.advertise.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="position" value="double">
                                        <div class="row">
                                            @if ($doubleAdvertise && $doubleAdvertise->isNotEmpty())
                                                @foreach ($doubleAdvertise as $advertise)
                                                    <div class="col-6 row">
                                                        <!-- Image Input -->
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>{{ __('Image') }}</label>
                                                                <div id="preview-{{ $advertise->id }}"
                                                                    class="image-preview w-100"
                                                                    @if (!empty($advertise->image)) style="background-image: url({{ asset($advertise->image) }}); background-size: cover; background-position: center center;" @endif>
                                                                    <label for="upload-{{ $advertise->id }}"
                                                                        id="label-{{ $advertise->id }}">{{ __('Image') }}</label>
                                                                    <input type="file"
                                                                        name="image[{{ $advertise->id }}]"
                                                                        id="upload-{{ $advertise->id }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Link Input -->
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <x-admin.form-input name="link[{{ $advertise->id }}]"
                                                                    label="{{ __('Link') }}"
                                                                    value="{{ $advertise->link ?? '' }}" />
                                                            </div>
                                                        </div>
                                                        <!-- Title Input -->
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <x-admin.form-input name="title[{{ $advertise->id }}]"
                                                                    label="{{ __('Title') }}"
                                                                    value="{{ $advertise->title ?? '' }}" />
                                                            </div>
                                                        </div>
                                                        <!-- Status Switch -->
                                                        <div class="col-6">
                                                            <label class="custom-switch mt-2">
                                                                <input type="checkbox"
                                                                    name="status[{{ $advertise->id }}]"
                                                                    class="custom-switch-input"
                                                                    {{ $advertise->status ? 'checked' : '' }}>
                                                                <span class="custom-switch-indicator"></span>
                                                                <span
                                                                    class="custom-switch-description">{{ __('Status') }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-6 row">
                                                    <!-- Image Input -->
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('Image') }}</label>
                                                            <div id="preview-1" class="image-preview w-100">
                                                                <label for="upload-1"
                                                                    id="label-1">{{ __('Image') }}</label>
                                                                <input type="file" name="image[]" id="upload-1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Link Input -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <x-admin.form-input name="link[]"
                                                                label="{{ __('Link') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- Title Input -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <x-admin.form-input name="title[]"
                                                                label="{{ __('Title') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- Status Switch -->
                                                    <div class="col-6">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status[]"
                                                                class="custom-switch-input" checked>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span
                                                                class="custom-switch-description">{{ __('Status') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 row">
                                                    <!-- Image Input -->
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>{{ __('Image') }}</label>
                                                            <div id="preview-2" class="image-preview w-100">
                                                                <label for="upload-2"
                                                                    id="label-2">{{ __('Image') }}</label>
                                                                <input type="file" name="image[]" id="upload-2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Link Input -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <x-admin.form-input name="link[]"
                                                                label="{{ __('Link') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- Title Input -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <x-admin.form-input name="title[]"
                                                                label="{{ __('Title') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- Status Switch -->
                                                    <div class="col-6">
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status[]"
                                                                class="custom-switch-input" checked>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span
                                                                class="custom-switch-description">{{ __('Status') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Save Button -->
                                            <div class="col-12 text-center mt-3">
                                                <div class="form-group">
                                                    <x-admin.save-button />
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        setupImagePreview('image-upload', 'image-preview', 'Update Image')
        setupImagePreview('upload-1', 'preview-1', 'Update Image');
        setupImagePreview('upload-2', 'preview-2', 'Update Image');
        setupImagePreview('upload-top', 'preview-top', 'Update Image');
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
