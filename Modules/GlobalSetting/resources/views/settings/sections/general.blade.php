<div class="tab-pane fade active show" id="general_tab" role="tabpanel">
    <form action="{{ route('admin.update-general-setting') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <x-admin.form-input id="app_name" name="app_name" label="{{ __('App Name') }}" value="{{ $setting->app_name }}"
                required="true" />
        </div>

        <div class="form-group">
            <x-admin.form-input id="editor" name="editor" label="{{ __('Editor') }}" value="{{ $setting->editor }}"
                required="true" />
        </div>

        <div class="form-group">
            <x-admin.form-input id="address" name="address" label="{{ __('Address') }}"
                value="{{ $setting->address }}" required="true" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="email" name="email" label="{{ __('Email') }}" value="{{ $setting->email }}"
                required="true" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="phone" name="phone" label="{{ __('Phone') }}" value="{{ $setting->phone }}"
                required="true" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="whatsapp" name="whatsapp" label="{{ __('Whatsapp') }}"
                value="{{ $setting->whatsapp }}" required="true" />
        </div>
        <div class="form-group">
            <x-admin.form-input id="channel" name="channel" label="{{ __('Channel') }}"
                value="{{ $setting->channel }}" required="true" />
        </div>

        <x-admin.update-button :text="__('Update')" />

    </form>
</div>
