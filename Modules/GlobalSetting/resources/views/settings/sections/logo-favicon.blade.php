<div class="tab-pane fade" id="logo_favicon_tab" role="tabpanel">
    <form action="{{ route('admin.update-logo-favicon') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-admin.form-image-preview :image="$setting->logo" name="logo" label="{{ __('Existing Logo') }}" button_label="{{ __('Update Image') }}" />
        </div>

        <div class="form-group">
            <x-admin.form-image-preview div_id="favicon-preview" label_id="favicon-label" input_id="favicon-upload" :image="$setting->favicon" name="favicon" label="{{ __('Existing Favicon') }}" button_label="{{ __('Update Image') }}" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
