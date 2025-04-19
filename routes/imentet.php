<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Imentet\{
    HomeController,
    ContactController,
    CareerController,
    DonationController,
    MembershipController,
    EventController,
    CartController,
    PaymentController,
    UserController
};

Route::prefix('Imentet')->controller(HomeController::class)->group(function () {
    Route::get('/',  'index')->name('index');
    Route::get('/our-story', 'about')->name('about');

    Route::name('imentet.')->group(function () {
        
        Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function () {
            Route::post('/store', 'store')->name('store');
        });

        Route::prefix('careers')->name('careers.')->controller(CareerController::class)->group(function () {
            Route::post('/store', 'store')->name('store');
        });

        Route::prefix('donations')->name('donations.')->controller(DonationController::class)->group(function () {
            Route::post('/store', 'store')->name('store');
        });

        Route::prefix('memberships')->name('memberships.')->controller(MembershipController::class)->group(function () {
            Route::post('/{membership}/checkout', 'checkout')->name('checkout');
            Route::post('/upload-documents',  'handleUploadDocuments')->name('handle-upload');
        });

        Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
            Route::post('/{event}/book',  'store')->name('store');
            Route::post('/{event}/feedback',  'storeFeedback')->name('feedback');
        });

        Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {

            Route::post('/add', 'addToCart')->name('add');
            Route::delete('/remove/{cartItemId}',  'removeFromCart')->name('remove');
            Route::delete('/clear','clear')->name('clearCart');
            Route::post('/update/{cartItemId}', 'update')->name('update');


            Route::prefix('checkout')->name('checkout.')->controller(PaymentController::class)->group(function () {
                Route::post('/process',  'process')->name('process');
                Route::post('/success',  'success')->name('success');
            });

        });

    });
});