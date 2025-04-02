<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Imentet\UserController;
use App\Http\Controllers\web\Imentet\ReviewController;

Route::prefix('profile')->middleware(['auth:web'])->name('profile.')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('index');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
});

Route::prefix('reviews')->middleware(['auth:web'])->name('reviews.')->group(function () {
    Route::post('/store', [ReviewController::class, 'store'])->name('store');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
});