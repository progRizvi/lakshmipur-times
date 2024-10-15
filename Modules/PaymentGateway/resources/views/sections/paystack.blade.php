<div class="tab-pane fade" id="paystack_tab" role="tabpanel">
    <form action="{{ route('admin.paystack-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-6">
                <x-admin.form-select id="paystack_currency_id" name="paystack_currency_id"
                    label="{{ __('Currency Name') }}" class="form-select">
                    <x-admin.select-option value="" text="{{ __('Select Currency') }}" />
                    @foreach ($currencies as $currency)
                        <x-admin.select-option :selected="$payment_setting->paystack_currency_id == $currency->id" value="{{ $currency->id }}"
                            text="{{ $currency->currency_name }}" />
                    @endforeach
                </x-admin.form-select>
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="paystack_charge" name="paystack_charge" label="{{ __('Gateway charge') }}(%)"
                    value="{{ $payment_setting->paystack_charge }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="paystack_public_key" name="paystack_public_key" label="{{ __('Public key') }}"
                    value="{{ $payment_setting->paystack_public_key }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="paystack_secret_key" name="paystack_secret_key" label="{{ __('Secret key') }}"
                    value="{{ $payment_setting->paystack_secret_key }}" />
            </div>

        </div>

        <div class="form-group">
            <x-admin.form-image-preview div_id="paystack_image_preview" label_id="paystack_image_label"
                input_id="paystack_image_upload" :image="$payment_setting->paystack_image" name="paystack_image"
                label="{{ __('Existing Image') }}" button_label="{{ __('Update Image') }}" />
        </div>
        <div class="form-group">
            <x-admin.form-switch name="paystack_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->paystack_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
