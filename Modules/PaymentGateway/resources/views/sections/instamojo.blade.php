<div class="tab-pane fade" id="instamojo_tab" role="tabpanel">
    <form action="{{ route('admin.instamojo-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="form-group col-md-6">
                <x-admin.form-select id="instamojo_currency_id" name="instamojo_currency_id"
                    label="{{ __('Currency Name') }}" class="form-select">
                    <x-admin.select-option value="" text="{{ __('Select Currency') }}" />
                    @foreach ($currencies as $currency)
                        <x-admin.select-option :selected="$payment_setting->instamojo_currency_id == $currency->id" value="{{ $currency->id }}"
                            text="{{ $currency->currency_name }}" />
                    @endforeach
                </x-admin.form-select>
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="instamojo_charge" name="instamojo_charge" label="{{ __('Gateway charge') }}(%)"
                    value="{{ $payment_setting->instamojo_charge }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="instamojo_api_key" name="instamojo_api_key" label="{{ __('API key') }}"
                    value="{{ $payment_setting->instamojo_api_key }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="instamojo_auth_token" name="instamojo_auth_token" label="{{ __('Auth token') }}"
                    value="{{ $payment_setting->instamojo_auth_token }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-select id="instamojo_account_mode" name="instamojo_account_mode"
                    label="{{ __('Account Mode') }}" class="form-select">
                    <x-admin.select-option :selected="$payment_setting->instamojo_account_mode == 'live'" value="live" text="{{ __('Live') }}" />
                    <x-admin.select-option :selected="$payment_setting->instamojo_account_mode == 'sandbox'" value="sandbox" text="{{ __('Sandbox') }}" />
                </x-admin.form-select>
            </div>

        </div>

        <div class="form-group">
            <x-admin.form-image-preview div_id="instamojo_image_preview" label_id="instamojo_image_label"
                input_id="instamojo_image_upload" :image="$payment_setting->instamojo_image" name="instamojo_image"
                label="{{ __('Existing Image') }}" button_label="{{ __('Update Image') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="instamojo_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->instamojo_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
