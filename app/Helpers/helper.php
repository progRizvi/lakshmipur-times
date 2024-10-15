<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\Language\app\Models\Language;
use Modules\GlobalSetting\app\Models\Setting;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\GlobalSetting\app\Models\CustomCode;
use Modules\BasicPayment\app\Models\BasicPayment;
use App\Exceptions\AccessPermissionDeniedException;
use Modules\PaymentGateway\app\Models\PaymentGateway;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

function file_upload(UploadedFile $file, string $path = 'uploads/custom-images/', string | null $oldFile = '', bool $optimize = false) {
    $extention = $file->getClientOriginalExtension();
    $file_name = 'wsus-img' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
    $file_name = $path . $file_name;
    $file->move(public_path($path), $file_name);

    try {
        if ($oldFile && !str($oldFile)->contains('uploads/website-images') && File::exists(public_path($oldFile))) {
            unlink(public_path($oldFile));
        }

        if ($optimize) {
            ImageOptimizer::optimize(public_path($file_name));
        }
    } catch (Exception $e) {
        Log::info($e->getMessage());
    }

    return $file_name;
}
// file upload method
if (!function_exists('allLanguages')) {
    function allLanguages() {
        $allLanguages = Cache::rememberForever('allLanguages', function () {
            return Language::select('code', 'name', 'direction', 'status')->get();
        });

        if (!$allLanguages) {
            $allLanguages = Language::select('code', 'name', 'direction', 'status')->get();
        }

        return $allLanguages;
    }
}

if (!function_exists('getSessionLanguage')) {
    function getSessionLanguage(): string {
        if (!session()->has('lang')) {
            session()->put('lang', config('app.locale'));
            session()->forget('text_direction');
            session()->put('text_direction', 'ltr');
        }

        $lang = Session::get('lang');

        return $lang;
    }
}
if (!function_exists('setLanguage')) {
    function setLanguage($code) {
        $lang = Language::whereCode($code)->first();

        if (session()->has('lang')) {
            sessionForgetLangChang();
        }
        if ($lang) {
            session()->put('lang', $lang->code);
            session()->put('text_direction', $lang->direction);
            return true;
        }
        session()->put('lang', config('app.locale'));
        return false;
    }
}
if (!function_exists('sessionForgetLangChang')) {
    function sessionForgetLangChang() {
        session()->forget('lang');
        session()->forget('text_direction');
    }
}

if (!function_exists('allCurrencies')) {
    function allCurrencies() {
        $allCurrencies = Cache::rememberForever('allCurrencies', function () {
            return MultiCurrency::all();
        });

        if (!$allCurrencies) {
            $allCurrencies = MultiCurrency::all();
        }

        return $allCurrencies;
    }
}

if (!function_exists('getSessionCurrency')) {
    function getSessionCurrency(): string {
        if (!session()->has('currency_code') || !session()->has('currency_rate') || !session()->has('currency_position')) {
            $currency = allCurrencies()->where('is_default', 'yes')->first();
            session()->put('currency_code', $currency->currency_code);
            session()->forget('currency_position');
            session()->put('currency_position', $currency->currency_position);
            session()->forget('currency_icon');
            session()->put('currency_icon', $currency->currency_icon);
            session()->forget('currency_rate');
            session()->put('currency_rate', $currency->currency_rate);
        }

        return Session::get('currency_code');
    }
}

function admin_lang() {
    return Session::get('admin_lang');
}

// calculate currency
function currency($price) {
    // currency information will be loaded by Session value

    // $currency_icon = Session::get('currency_icon');
    // $currency_code = Session::get('currency_code');
    // $currency_rate = Session::get('currency_rate');
    // $currency_position = Session::get('currency_position');

    $currency_icon = '$';
    $currency_code = 'USD';
    $currency_rate = '1.00';
    $currency_position = 'before_price';

    $price = $price * $currency_rate;
    $price = number_format($price, 2, '.', ',');

    if ($currency_position == 'before_price') {
        $price = $currency_icon . $price;
    } elseif ($currency_position == 'before_price_with_space') {
        $price = $currency_icon . ' ' . $price;
    } elseif ($currency_position == 'after_price') {
        $price = $price . $currency_icon;
    } elseif ($currency_position == 'after_price_with_space') {
        $price = $price . ' ' . $currency_icon;
    } else {
        $price = $currency_icon . $price;
    }

    return $price;
}

// calculate currency

// custom decode and encode input value
function html_decode($text) {
    $after_decode = htmlspecialchars_decode($text, ENT_QUOTES);

    return $after_decode;
}
if (!function_exists('currectUrlWithQuery')) {
    function currectUrlWithQuery($code) {
        $currentUrlWithQuery = request()->fullUrl();

        // Parse the query string
        $parsedQuery = parse_url($currentUrlWithQuery, PHP_URL_QUERY);

        // Check if the 'code' parameter already exists
        $codeExists = false;
        if ($parsedQuery) {
            parse_str($parsedQuery, $queryArray);
            $codeExists = isset($queryArray['code']);
        }

        if ($codeExists) {
            $updatedUrlWithQuery = preg_replace('/(\?|&)code=[^&]*/', '$1code=' . $code, $currentUrlWithQuery);
        } else {
            $updatedUrlWithQuery = $currentUrlWithQuery . ($parsedQuery ? '&' : '?') . http_build_query(['code' => $code]);
        }
        return $updatedUrlWithQuery;
    }
}

if (!function_exists('checkAdminHasPermission')) {
    function checkAdminHasPermission($permission): bool {
        return Auth::guard('admin')->user()->can($permission) ? true : false;
    }
}

if (!function_exists('checkAdminHasPermissionAndThrowException')) {
    function checkAdminHasPermissionAndThrowException($permission) {
        if (!checkAdminHasPermission($permission)) {
            throw new AccessPermissionDeniedException();
        }
    }
}

if (!function_exists('getSettingStatus')) {
    function getSettingStatus($key) {
        if (Cache::has('setting')) {
            $setting = Cache::get('setting');
            if (!is_null($key)) {
                return $setting->$key == 'active' ? true : false;
            }
        } else {
            try {
                return Setting::where('key', $key)->first()?->value == 'active' ? true : false;
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return false;
            }
        }

        return false;
    }
}
if (!function_exists('checkCrentials')) {
    function checkCrentials() {
        if (Cache::has('setting') && $settings = Cache::get('setting')) {

            $checkCrentials = [];

            if ($settings->mail_host == 'mail_host' || $settings->mail_username == 'mail_username' || $settings->mail_password == 'mail_password' || $settings->mail_host == '' || $settings->mail_port == '' || $settings->mail_username == '' || $settings->mail_password == '') {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Mail credentails not found'),
                    'description' => __('This may create a problem while sending email. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.email-configuration',
                ];
            }

            if ($settings->recaptcha_status !== 'inactive' && ($settings->recaptcha_site_key == 'recaptcha_site_key' || $settings->recaptcha_secret_key == 'recaptcha_secret_key' || $settings->recaptcha_site_key == '' || $settings->recaptcha_secret_key == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Recaptcha credentails not found'),
                    'description' => __('This may create a problem while submitting any form submission from website. Please fill up the credential from google account.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }
            if ($settings->googel_tag_status !== 'inactive' && ($settings->googel_tag_id == 'googel_tag_id' || $settings->googel_tag_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Tag credentails not found'),
                    'description' => __('This may create a problem with analyzing your website through Google Tag Manager. Please fill in the credentials to avoid any issues.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->pixel_status !== 'inactive' && ($settings->pixel_app_id == 'pixel_app_id' || $settings->pixel_app_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Facebook Pixel credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->google_login_status !== 'inactive' && ($settings->gmail_client_id == 'google_client_id' || $settings->gmail_secret_id == 'google_secret_id' || $settings->gmail_client_id == '' || $settings->gmail_secret_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google login credentails not found'),
                    'description' => __('This may create a problem while logging in using google. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->google_analytic_status !== 'inactive' && ($settings->google_analytic_id == 'google_analytic_id' || $settings->google_analytic_id == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Google Analytic credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->tawk_status !== 'inactive' && ($settings->tawk_chat_link == 'tawk_chat_link' || $settings->tawk_chat_link == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Tawk Chat Link credentails not found'),
                    'description' => __('This may create a problem to analyze your website. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            if ($settings->pusher_status !== 'inactive' && ($settings->pusher_app_id == 'pusher_app_id' || $settings->pusher_app_key == 'pusher_app_key' || $settings->pusher_app_secret == 'pusher_app_secret' || $settings->pusher_app_cluster == 'pusher_app_cluster' || $settings->pusher_app_id == '' || $settings->pusher_app_key == '' || $settings->pusher_app_secret == '' || $settings->pusher_app_cluster == '')) {
                $checkCrentials[] = (object) [
                    'status'      => true,
                    'message'     => __('Pusher credentails not found'),
                    'description' => __('This may create a problem while logging in using google. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.crediential-setting',
                ];
            }

            return (object) $checkCrentials;
        }

        if (!Cache::has('basic_payment') && Module::isEnabled('BasicPayment')) {
            Cache::rememberForever('basic_payment', function () {
                $payment_info = BasicPayment::get();
                $basic_payment = [];
                foreach ($payment_info as $payment_item) {
                    $basic_payment[$payment_item->key] = $payment_item->value;
                }

                return (object) $basic_payment;
            });
        }

        if (Cache::has('basic_payment') && $basicPayment = Cache::get('basic_payment')) {
            if ($basicPayment->stripe_status !== 'inactive' && ($basicPayment->stripe_key == 'stripe_key' || $basicPayment->stripe_secret == 'stripe_secret' || $basicPayment->stripe_key == '' || $basicPayment->stripe_secret == '')) {

                return (object) [
                    'status'      => true,
                    'message'     => __('Stripe credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }

            if ($basicPayment->paypal_status !== 'inactive' && ($basicPayment->paypal_client_id == 'paypal_client_id' || $basicPayment->paypal_secret_key == 'paypal_secret_key' || $basicPayment->paypal_client_id == '' || $basicPayment->paypal_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Paypal credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.basicpayment',
                ];
            }
        }

        if (!Cache::has('payment_setting') && Module::isEnabled('PaymentGateway')) {
            Cache::rememberForever('payment_setting', function () {
                $payment_info = PaymentGateway::get();
                $payment_setting = [];
                foreach ($payment_info as $payment_item) {
                    $payment_setting[$payment_item->key] = $payment_item->value;
                }

                return (object) $payment_setting;
            });
        }

        if (Cache::has('payment_setting') && $paymentAddons = Cache::get('payment_setting')) {
            if ($paymentAddons->razorpay_status !== 'inactive' && ($paymentAddons->razorpay_key == 'razorpay_key' || $paymentAddons->razorpay_secret == 'razorpay_secret' || $paymentAddons->razorpay_key == '' || $paymentAddons->razorpay_secret == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Razorpay credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.paymentgateway',
                ];
            }

            if ($paymentAddons->flutterwave_status !== 'inactive' && ($paymentAddons->flutterwave_public_key == 'flutterwave_public_key' || $paymentAddons->flutterwave_secret_key == 'flutterwave_secret_key' || $paymentAddons->flutterwave_public_key == '' || $paymentAddons->flutterwave_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Flutterwave credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.paymentgateway',
                ];
            }

            if ($paymentAddons->paystack_status !== 'inactive' && ($paymentAddons->paystack_public_key == 'paystack_public_key' || $paymentAddons->paystack_secret_key == 'paystack_secret_key' || $paymentAddons->paystack_public_key == '' || $paymentAddons->paystack_secret_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Paystack credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.paymentgateway',
                ];
            }

            if ($paymentAddons->mollie_status !== 'inactive' && ($paymentAddons->mollie_key == 'mollie_key' || $paymentAddons->mollie_key == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Mollie credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.paymentgateway',
                ];
            }

            if ($paymentAddons->instamojo_status !== 'inactive' && ($paymentAddons->instamojo_api_key == 'instamojo_api_key' || $paymentAddons->instamojo_auth_token == 'instamojo_auth_token' || $paymentAddons->instamojo_api_key == '' || $paymentAddons->instamojo_auth_token == '')) {
                return (object) [
                    'status'      => true,
                    'message'     => __('Instamojo credentails not found'),
                    'description' => __('This may create a problem while making payment. Please fill up the credential to avoid any problem.'),
                    'route'       => 'admin.paymentgateway',
                ];
            }
        }

        return false;
    }
}

if (!function_exists('isRoute')) {
    function isRoute(string | array $route, string $returnValue = null) {
        if (is_array($route)) {
            foreach ($route as $value) {
                if (Route::is($value)) {
                    return is_null($returnValue) ? true : $returnValue;
                }
            }
            return false;
        }

        if (Route::is($route)) {
            return is_null($returnValue) ? true : $returnValue;
        }

        return false;
    }
}
if (!function_exists('customCode')) {
    function customCode() {
        return Cache::rememberForever('customCode', function () {
            return CustomCode::select('css', 'header_javascript', 'body_javascript', 'footer_javascript')->first();
        });
    }
}