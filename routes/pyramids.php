<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Pyramids\{
    HomeController,
    NavbarController
};
use App\Http\Controllers\web\Imentet\{
    AboutController,
    EventController,
    MembershipController,
    CollectionController,
    ShopController,
    CartController,
    TicketController,
    PaymentController,
    ContactController,
    CareerController,
    DonationController,
    FaqController,
    StripeController
};

Route::prefix('Pyramids')->name('pyramids.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar.index');

    Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/',  'pyramidsEvents')->name('index');
        Route::get('/{event}',  'pyramidsEventsShow')->name('show');
    });

    Route::prefix('memberships')->name('memberships.')->controller(MembershipController::class)->group(function () {
        Route::get('/', 'pyramidsMemberships')->name('index');;
        Route::get('/{membership}',  'showInPyramids')->name('show');
        Route::get('/{membership}/VIP', 'vips')->name('vip');
        Route::get('/success/{membership}/{membershipPrice}',  'paymentSuccess')->name('success');
        Route::get('/upload-documents/{token}', 'uploadDocuments')->name('upload-documents');
        Route::get('/membership/cancel', 'paymentCancel')->name('cancel');
    });

    Route::prefix('collections')->name('collections.')->controller(CollectionController::class)->group(function () {
        Route::get('/',  'pyramidsCollections')->name('index');
        Route::get('/{collection}',  'show')->name('show');
        Route::get('/category/{slug}', 'showByCategory')->name('category');

    });

    Route::prefix('shop')->name('shop.')->controller(ShopController::class)->group(function () {
        Route::get('/', 'pyramidsShop')->name('index');
        Route::get('/{shopItem}',  'pyramidsShow')->name('products.show');
        Route::get('/cart','cart')->name('cart');
    });

    Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
        Route::get('/', 'pyramidsCart')->name('index');
        Route::get('/checkout', 'pyramidsCheckout')->name('checkout');
    });

    Route::get('/about-us', [AboutController::class, 'pyramidsAbout'])->name('about');

    Route::prefix('tickets')->name('tickets.')->controller(TicketController::class)->group(function () {
        Route::get('/', 'pyramidsTickets')->name('index');
        Route::post('/selections', 'storeSelections')->name('storeSelections');
        Route::get('/plan-visit', 'pyramidsPlanVisit')->name('plan-visit');
    });

    Route::prefix('payments')->name('payments.')->controller(PaymentController::class)->group(function () {
        Route::get('/tickets', 'ticketsPayment')->name('tickets');
    });

    Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/', 'pyramidsContact')->name('index');
    });

    Route::prefix('careers')->name('careers.')->controller(CareerController::class)->group(function () {
        Route::get('/', 'pyramidsCareers')->name('index');
    });

    Route::prefix('donations')->name('donations.')->controller(DonationController::class)->group(function () {
        Route::get('/', 'pyramidsDonations')->name('index');
        Route::get('/success/{donation}', 'success')->name('success');
        Route::get('/cancel/{donation}', 'cancel')->name('cancel');
    });

    Route::get('/faqs', [FaqController::class, 'gemFaqs'])->name('faqs');

    Route::get('/stripe/checkout/{payment}', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success/{payment}', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{payment}', [StripeController::class, 'cancel'])->name('stripe.cancel');

});
