<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\Museum\{
    HomeController,
    NavbarController
};
use App\Http\Controllers\web\Imentet\{
    AboutController,
    BlogController,
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
    StripeController,
};

Route::prefix('GEM')->name('gem.')->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar.index');

    Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/',  'gemEvents')->name('index');
        Route::get('/{event}',  'gemEventsShow')->name('show');
    });

    Route::prefix('memberships')->name('memberships.')->controller(MembershipController::class)->group(function () {
        Route::get('/', 'gemMemberships')->name('index');;
        Route::get('/{membership}',  'show')->name('show');
        Route::get('/{membership}/VIP', 'vips')->name('vip');
        Route::get('/success/{membership}/{membershipPrice}',  'paymentSuccess')->name('success');
        Route::get('/upload-documents/{token}', 'uploadDocuments')->name('upload-documents');
        Route::get('/membership/cancel', 'paymentCancel')->name('cancel');
    });

    Route::prefix('collections')->name('collections.')->controller(CollectionController::class)->group(function () {
        Route::get('/',  'gemCollections')->name('index');
        Route::get('/{collection}',  'show')->name('show');
        Route::get('/category/{slug}', 'showByCategory')->name('category');

    });

    Route::prefix('shop')->name('shop.')->controller(ShopController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{shopItem}',  'show')->name('products.show');
        Route::get('/cart','cart')->name('cart');
    });

    Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/checkout', 'checkout')->name('checkout');
    });

    Route::get('/about-us', [AboutController::class, 'gemAbout'])->name('about');

    Route::prefix('tickets')->name('tickets.')->controller(TicketController::class)->group(function () {
        Route::get('/', 'gemTickets')->name('index');
        Route::get('/plan-visit', 'gemPlanVisit')->name('plan-visit');
        Route::get('/payment', 'processPayment')->name('payment');
        Route::get('/success', 'paymentSuccess')->name('success');
    });

    Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
        Route::get('/', 'gemBlog')->name('index');
    });

    Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/', 'gemContact')->name('index');
    });

    Route::get('/faqs', [FaqController::class, 'gemFaqs'])->name('faqs');

    Route::prefix('careers')->name('careers.')->controller(CareerController::class)->group(function () {
        Route::get('/', 'gemCareers')->name('index');
    });

    Route::prefix('donations')->name('donations.')->controller(DonationController::class)->group(function () {
        Route::get('/', 'gemDonations')->name('index');
        Route::get('/success/{donation}', 'success')->name('success');
        Route::get('/cancel/{donation}', 'cancel')->name('cancel');
    });

    // Stripe Payment Routes
    Route::get('/stripe/checkout/{payment}', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

    // Cart Stripe Payment Routes
    Route::get('/stripe/cart/checkout', [StripeController::class, 'cartCheckout'])->name('stripe.cart.checkout');
    Route::get('/stripe/cart/success', [StripeController::class, 'cartSuccess'])->name('stripe.cart.success');
    Route::get('/stripe/cart/cancel', [StripeController::class, 'cartCancel'])->name('stripe.cart.cancel');

});