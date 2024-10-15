<?php

use Illuminate\Support\Facades\Route;
use Modules\FileManager\app\Http\Controllers\FileManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin/file-manager','middleware' => ['auth:admin', 'translation']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});