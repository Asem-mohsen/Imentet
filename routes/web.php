<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\Auth\LogoutController;
use App\Http\Controllers\web\Auth\ForgetPasswordController;
use App\Http\Controllers\web\Auth\LoginController;
use App\Http\Controllers\web\Auth\RegisterController;

use App\Http\Controllers\web\Imentet\CareerController;
use App\Http\Controllers\web\Imentet\CartController;
use App\Http\Controllers\web\Imentet\CollectionController;
use App\Http\Controllers\web\Imentet\DonationController;
use App\Http\Controllers\web\Imentet\EventController;
use App\Http\Controllers\web\Imentet\FaqController;
use App\Http\Controllers\web\Imentet\MembershipController;
use App\Http\Controllers\web\Imentet\ShopController;
use App\Http\Controllers\web\Imentet\TicketController;
use App\Http\Controllers\web\Imentet\AboutController;
use App\Http\Controllers\web\Imentet\ContactController;
use App\Http\Controllers\web\Imentet\HomeController as ImentetHomeController;
use App\Http\Controllers\web\Imentet\PaymentController;
use App\Http\Controllers\web\Imentet\StripeController;
use App\Http\Controllers\web\Imentet\UserController;

use App\Http\Controllers\web\Museum\HomeController;
use App\Http\Controllers\web\Museum\NavbarController;

use App\Http\Controllers\web\Pyramids\HomeController as PyramidsHomeController;
use App\Http\Controllers\web\Pyramids\NavbarController as PyramidsNavController;

Route::middleware(['guest.only'])->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {

        Route::controller(RegisterController::class)->name('register.')->group(function () {
            Route::get('/register',  'index')->name('index');
            Route::post('/register', 'register')->name('store');
        });

        Route::controller(LoginController::class)->name('login.')->group(function () {
            Route::get('/login',  'index')->name('index');
            Route::post('/login', 'login')->name('store');
        });

        Route::controller(ForgetPasswordController::class)->group(function () {
            Route::get('/forget-password',  'forgetPassword')->name('forget-password');
            Route::get('/reset-password', 'resetPassword')->name('reset-password');
        });

    });
});

Route::prefix('auth')->middleware(['auth:web'])->group(function () {
    Route::prefix('logout')->group(function () {
        Route::post('/current', [LogoutController::class, 'logoutFromCurrentSession'])->name('auth.logout.current');
        Route::post('/all', [LogoutController::class, 'logoutFromAllSessions'])->name('auth.logout.all');
        Route::post('/others', [LogoutController::class, 'logoutFromOtherSessions'])->name('auth.logout.others');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('index');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/delete', [UserController::class, 'destroy'])->name('delete');
    });
});

Route::prefix('Imentet')->controller(ImentetHomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
});

Route::prefix('GEM')->name('gem.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar.index');

    Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/',  'gemEvents')->name('index');
        Route::get('/{event}',  'gemEventsShow')->name('show');
        Route::post('/{event}/book',  'store')->name('store');
    });

    Route::prefix('memberships')->name('memberships.')->controller(MembershipController::class)->group(function () {
        Route::get('/', 'gemMemberships')->name('index');;
        Route::get('/{membership}',  'show')->name('show');
        Route::get('/{membership}/VIP', 'vips')->name('vip');
        Route::post('/{membership}/checkout', 'checkout')->name('checkout');
        Route::get('/success/{membership}/{membershipPrice}',  'paymentSuccess')->name('success');
        Route::get('/upload-documents/{token}', 'uploadDocuments')->name('upload-documents');
        Route::post('/upload-documents',  'handleUploadDocuments')->name('handle-upload');
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
        Route::post('/add', 'addToCart')->name('add');
        Route::post('/update/{cartItemId}', 'update')->name('update');
        Route::delete('/remove/{cartItemId}',  'removeFromCart')->name('remove');
        Route::delete('/clear','clear')->name('clearCart');
    });

    Route::get('/about-us', [AboutController::class, 'gemAbout'])->name('about');

    Route::prefix('tickets')->name('tickets.')->controller(TicketController::class)->group(function () {
        Route::get('/', 'gemTickets')->name('index');
        Route::post('/selections', 'storeSelections')->name('storeSelections');
        Route::get('/plan-visit', 'gemPlanVisit')->name('plan-visit');
    });

    Route::prefix('payments')->name('payments.')->controller(PaymentController::class)->group(function () {
        Route::get('/tickets', 'ticketsPayment')->name('tickets');
    });

    Route::prefix('contact-us')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/', 'gemContact')->name('index');
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('careers')->name('careers.')->controller(CareerController::class)->group(function () {
        Route::get('/', 'gemCareers')->name('index');
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('donations')->name('donations.')->controller(DonationController::class)->group(function () {
        Route::get('/', 'gemDonations')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/success/{donation}', 'success')->name('success');
        Route::get('/cancel/{donation}', 'cancel')->name('cancel');
    });

    Route::get('/faqs', [FaqController::class, 'gemFaqs'])->name('faqs');

    Route::get('/stripe/checkout/{payment}', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success/{payment}', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{payment}', [StripeController::class, 'cancel'])->name('stripe.cancel');
});

Route::prefix('Pyramids')->name('pyramids.')->group(function () {

    Route::get('/', [PyramidsHomeController::class, 'index'])->name('home');

    Route::get('/navbar', [PyramidsNavController::class, 'index'])->name('navbar.index');

    Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
        Route::get('/',  'pyramidsEvents')->name('index');
        Route::get('/{event}',  'pyramidsEventsShow')->name('show');
        Route::post('/{event}/book',  'store')->name('store');
    });

    Route::prefix('memberships')->name('memberships.')->controller(MembershipController::class)->group(function () {
        Route::get('/', 'pyramidsMemberships')->name('index');;
        Route::get('/{membership}',  'showInPyramids')->name('show');
        Route::get('/{membership}/VIP', 'vips')->name('vip');
        Route::post('/{membership}/checkout', 'checkout')->name('checkout');
        Route::get('/success/{membership}/{membershipPrice}',  'paymentSuccess')->name('success');
        Route::get('/upload-documents/{token}', 'uploadDocuments')->name('upload-documents');
        Route::post('/upload-documents',  'handleUploadDocuments')->name('handle-upload');
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
        Route::post('/add', 'addToCart')->name('add');
        Route::post('/update/{cartItemId}', 'update')->name('update');
        Route::delete('/remove/{cartItemId}',  'removeFromCart')->name('remove');
        Route::delete('/clear','clear')->name('clearCart');
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
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('careers')->name('careers.')->controller(CareerController::class)->group(function () {
        Route::get('/', 'pyramidsCareers')->name('index');
        Route::post('/store', 'store')->name('store');
    });

    Route::prefix('donations')->name('donations.')->controller(DonationController::class)->group(function () {
        Route::get('/', 'pyramidsDonations')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/success/{donation}', 'success')->name('success');
        Route::get('/cancel/{donation}', 'cancel')->name('cancel');
    });

    Route::get('/faqs', [FaqController::class, 'gemFaqs'])->name('faqs');

    Route::get('/stripe/checkout/{payment}', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success/{payment}', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{payment}', [StripeController::class, 'cancel'])->name('stripe.cancel');

});