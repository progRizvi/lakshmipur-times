<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CoinGateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('admin.dashboard');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web', 'verified'])->name('dashboard');

//maintenance mode route
Route::get('/maintenance-mode', function () {
    $setting = Illuminate\Support\Facades\Cache::get('setting', null);
    if (!$setting?->maintenance_mode) {
        return redirect()->route('home');
    }

    return view('maintenance');
})->name('maintenance.mode');

//Profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/update-password', [ProfileController::class, 'update_password'])->name('user.update-password');
});

Route::get('set-language', [DashboardController::class, 'setLanguage'])->name('set-language');
Route::get('set-currency', [DashboardController::class, 'setCurrency'])->name('set-currency');

Route::post('apply-coupon', [PaymentController::class, 'apply_coupon'])->name('apply-coupon');

/**payment related route start */

Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('pay-via-stripe', [PaymentController::class, 'stripe_pay'])->name('pay-via-stripe');
Route::get('pay-via-stripe', [PaymentController::class, 'stripe_success'])->name('stripe-success');

Route::get('pay-via-paypal', [PaymentController::class, 'pay_via_paypal'])->name('pay-via-paypal');

Route::post('pay-via-bank', [PaymentController::class, 'pay_via_bank'])->name('pay-via-bank');

Route::post('pay-via-razorpay', [PaymentController::class, 'pay_via_razorpay'])->name('pay-via-razorpay');

Route::get('pay-via-mollie', [PaymentController::class, 'pay_via_mollie'])->name('pay-via-mollie');
Route::get('pay-via-instamojo', [PaymentController::class, 'pay_via_instamojo'])->name('pay-via-instamojo');

Route::get('/payment-addon-success', [PaymentController::class, 'payment_addon_success'])->name('payment-addon-success');
Route::get('/payment-addon-failed', [PaymentController::class, 'payment_addon_faild'])->name('payment-addon-faild');

// SSLCOMMERZ
Route::post('/sslcommerz-pay', [SslCommerzPaymentController::class, 'index'])->name('pay-via-sslcommerz');
Route::post('/sslcommerz-success', [SslCommerzPaymentController::class, 'success']);
Route::post('/sslcommerz-fail', [SslCommerzPaymentController::class, 'fail_and_cancel']);
Route::post('/sslcommerz-cancel', [SslCommerzPaymentController::class, 'fail_and_cancel']);
Route::post('/sslcommerz-ipn', [SslCommerzPaymentController::class, 'ipn']);

Route::middleware('auth')->group(function () {
    Route::get('/crypto/payment', [CoinGateController::class, 'createPayment'])->name('pay-via-crypto');
    Route::get('/coin-gate/callback/{?token}', [CoinGateController::class, 'handleCallback']);
    Route::get('/coin-gate/success', [CoinGateController::class, 'success']);
});

/**payment related route end */

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

Route::fallback(function () {
    abort(404);
});