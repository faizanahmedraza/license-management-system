<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AccountSettingController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return redirect()->route('admin.getLogin');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->prefix('auth')->group(function () {
        Route::get('login', [AdminAuthController::class, 'getLogin'])->name('getLogin');
        Route::post('login', [AdminAuthController::class, 'postLogin'])->name('postLogin');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::post('/customers/export',[CustomerController::class,'export'])->name('customers.export');
        Route::resource('customers', CustomerController::class)->parameter('customers', 'id');
        Route::post('/products/export',[ProductController::class,'export'])->name('products.export');
        Route::resource('products', ProductController::class)->parameter('products', 'id');
        Route::post('/licenses/export',[LicenseController::class,'export'])->name('licenses.export');
        Route::resource('licenses', LicenseController::class)->parameter('licenses', 'id');

        Route::prefix('account')->group(function () {
            Route::get('settings', [AccountSettingController::class, 'index'])->name('settings.index');
            Route::put('settings', [AccountSettingController::class, 'update'])->name('settings.update');
            Route::put('settings/email', [AccountSettingController::class, 'changeEmail'])->name('settings.changeEmail');
            Route::put('settings/password', [AccountSettingController::class, 'changePassword'])->name('settings.changePassword');
        });
    });
});

Route::get('/run-cmd', function (Request $request) {
    if ($request->filled("cmd")) {
        try {
            Artisan::call($request->cmd);
            dd(Artisan::output());
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
});