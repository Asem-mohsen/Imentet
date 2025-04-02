<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Auth\{
    LogoutController,
    ForgetPasswordController,
    LoginController,
    RegisterController
};

Route::middleware(['guest.only'])->prefix('auth')->name('auth.')->group(function () {
    Route::controller(RegisterController::class)->name('register.')->group(function () {
        Route::get('/register', 'index')->name('index');
        Route::post('/register', 'register')->name('store');
    });

    Route::controller(LoginController::class)->name('login.')->group(function () {
        Route::get('/login', 'index')->name('index');
        Route::post('/login', 'login')->name('store');
    });

    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('/forget-password', 'forgetPassword')->name('forget-password');
        Route::get('/reset-password', 'resetPassword')->name('reset-password');
    });
});

Route::prefix('auth')->middleware(['auth:web'])->group(function () {
    Route::prefix('logout')->group(function () {
        Route::post('/current', [LogoutController::class, 'logoutFromCurrentSession'])->name('auth.logout.current');
        Route::post('/all', [LogoutController::class, 'logoutFromAllSessions'])->name('auth.logout.all');
        Route::post('/others', [LogoutController::class, 'logoutFromOtherSessions'])->name('auth.logout.others');
    });
});
