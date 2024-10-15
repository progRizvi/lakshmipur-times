<div class="tab-pane fade" id="crypto_tab" role="tabpanel">
    <form action="{{ route('admin.crypto-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-admin.form-select id="crypto_sandbox" name="crypto_sandbox"
                        label="{{ __('Account Mode') }}" class="form-select">
                        <x-admin.select-option :selected="$payment_setting->crypto_sandbox == '0'" value="0" text="{{ __('Live') }}" />
                        <x-admin.select-option :selected="$payment_setting->crypto_sandbox == '1'" value="1" text="{{ __('Sandbox') }}" />
                    </x-admin.form-select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-admin.form-input id="crypto_api_key" name="crypto_api_key" label="{{ __('API Key') }}"
                        value="{{ $payment_setting->crypto_api_key }}" required="true" />
                </div>
            </div>
        </div>

        <div class="form-group">
            <x-admin.form-image-preview div_id="crypto_image_preview" label_id="crypto_image_label"
                input_id="crypto_image_upload" :image="$payment_setting->crypto_image" name="crypto_image" label="{{ __('Existing Image') }}"
                button_label="{{ __('Update Image') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="crypto_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->crypto_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
