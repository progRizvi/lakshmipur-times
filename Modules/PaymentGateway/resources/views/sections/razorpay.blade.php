<div class="tab-pane fade active show" id="razorpay_tab" role="tabpanel">
    <form action="{{ route('admin.razorpay-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="form-group col-md-6">
                <x-admin.form-select id="razorpay_currency_id" name="razorpay_currency_id"
                    label="{{ __('Currency Name') }}" class="form-select">
                    <x-admin.select-option value="" text="{{ __('Select Currency') }}" />
                    @foreach ($currencies as $currency)
                        <x-admin.select-option :selected="$payment_setting->razorpay_currency_id == $currency->id" value="{{ $currency->id }}"
                            text="{{ $currency->currency_name }}" />
                    @endforeach
                </x-admin.form-select>
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="razorpay_charge" name="razorpay_charge" label="{{ __('Gateway charge') }}(%)"
                    value="{{ $payment_setting->razorpay_charge }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="razorpay_key" name="razorpay_key" label="{{ __('Razorpay key') }}"
                    value="{{ $payment_setting->razorpay_key }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="razorpay_secret" name="razorpay_secret" label="{{ __('Razorpay secret') }}"
                    value="{{ $payment_setting->razorpay_secret }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="razorpay_name" name="razorpay_name" label="{{ __('Razorpay App Name') }}"
                    value="{{ $payment_setting->razorpay_name }}" />
            </div>

            <div class="form-group col-md-6">
                <x-admin.form-input id="razorpay_description" name="razorpay_description"
                    label="{{ __('Razorpay Description') }}" value="{{ $payment_setting->razorpay_description }}" />
            </div>

            <div class="form-group col-md-12">
                <x-admin.form-input type="color" id="razorpay_theme_color" name="razorpay_theme_color"
                    label="{{ __('Theme color') }}" value="{{ $payment_setting->razorpay_theme_color }}" />
            </div>
        </div>

        <div class="form-group">
            <x-admin.form-image-preview div_id="razorpay_image_preview" label_id="razorpay_image_label"
                input_id="razorpay_image_upload" :image="$payment_setting->razorpay_image" name="razorpay_image"
                label="{{ __('Existing Image') }}" button_label="{{ __('Update Image') }}" />
        </div>

        <div class="form-group">
            <x-admin.form-switch name="razorpay_status" label="{{ __('Status') }}" active_value="active"
                inactive_value="inactive" :checked="$payment_setting->razorpay_status == 'active'" />
        </div>

        <x-admin.update-button :text="__('Update')" />
    </form>
</div>
