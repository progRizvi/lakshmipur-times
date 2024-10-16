<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CoinGateController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/search', [WebsiteController::class, 'search'])->name('search');
Route::get('/category/{slug}', [WebsiteController::class, 'category'])->name('category');
Route::get('/news/{slug}', [WebsiteController::class, 'newsDetails'])->name('news.details');
Route::post('/comment/post', [WebsiteController::class, 'commentPost'])->name('comment.post');
Route::get('pages/{slug}', [WebsiteController::class, 'pages'])->name('pages');
Route::get('team', [WebsiteController::class, 'team'])->name('team');
Route::get('contact-us', [WebsiteController::class, 'contact'])->name('contact');

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


Route::get('set-language', [DashboardController::class, 'setLanguage'])->name('set-language');
Route::get('set-currency', [DashboardController::class, 'setCurrency'])->name('set-currency');





require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

Route::fallback(function () {
    abort(404);
});
