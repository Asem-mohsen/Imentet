<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Imentet\HomeController;

Route::prefix('Imentet')->controller(HomeController::class)->group(function () {
    Route::get('/',  'index')->name('index');
    Route::get('/our-story', 'about')->name('about');
});