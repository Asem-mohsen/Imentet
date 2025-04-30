<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Auth\{
    LogoutController,
    PasswordResetController,
    LoginController,
    RegisterController
};
use App\Http\Controllers\web\Imentet\UserController;

Route::middleware(['guest.only' , 'throttle:6,1'])->prefix('auth')->name('auth.')->group(function () {
    Route::controller(RegisterController::class)->name('register.')->group(function () {
        Route::get('/register', 'index')->name('index');
        Route::post('/register', 'register')->name('store');
    });

    Route::controller(LoginController::class)->name('login.')->group(function () {
        Route::get('/login', 'index')->name('index');
        Route::post('/login', 'login')->name('store');
    });

    Route::controller(PasswordResetController::class)->prefix('password')->name('password.')->group(function () {
        Route::get('/reset', 'showRequestForm')->name('request');
        Route::post('/email', 'sendResetLinkEmail')->name('email');
        Route::get('/reset/{token}', 'showResetForm')->name('reset');
        Route::post('/reset',  'reset')->name('update');

    });

});

Route::prefix('auth')->middleware(['auth:web'])->group(function () {
    Route::prefix('logout')->group(function () {
        Route::post('/current', [LogoutController::class, 'logoutFromCurrentSession'])->name('auth.logout.current');
        Route::post('/all', [LogoutController::class, 'logoutFromAllSessions'])->name('auth.logout.all');
        Route::post('/others', [LogoutController::class, 'logoutFromOtherSessions'])->name('auth.logout.others');
    });

    Route::controller(UserController::class)->prefix('/user')->name('user.')->middleware(['auth'])->group(function () {
        Route::post('/update-phone',  'updatePhone')->name('updatePhone');
        Route::post('/update-contact', 'updateContact')->name('update-contact');
    });
});
