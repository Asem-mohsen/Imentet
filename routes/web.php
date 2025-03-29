<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\Auth\LogoutController;
use App\Http\Controllers\web\Auth\ForgetPasswordController;
use App\Http\Controllers\web\Auth\LoginController;
use App\Http\Controllers\web\Auth\RegisterController;

use App\Http\Controllers\web\Admin\AdminController;
use App\Http\Controllers\web\Admin\CareerController;
use App\Http\Controllers\web\Admin\CartController;
use App\Http\Controllers\web\Admin\CollectionController;
use App\Http\Controllers\web\Admin\ContractController;
use App\Http\Controllers\web\Admin\DonationController;
use App\Http\Controllers\web\Admin\EventController;
use App\Http\Controllers\web\Admin\FaqController;
use App\Http\Controllers\web\Admin\FeatureController;
use App\Http\Controllers\web\Admin\GiftShopController;
use App\Http\Controllers\web\Admin\MembershipController;
use App\Http\Controllers\web\Admin\PlaceController;
use App\Http\Controllers\web\Admin\RoleController;
use App\Http\Controllers\web\Admin\SaleController;
use App\Http\Controllers\web\Admin\ShopController;
use App\Http\Controllers\web\Admin\StationController;
use App\Http\Controllers\web\Admin\TicketController;
use App\Http\Controllers\web\Admin\TransportationController;
use App\Http\Controllers\web\Admin\VisitorTypesController;
use App\Http\Controllers\web\Museum\AboutController as MuseumAboutController;
use App\Http\Controllers\web\Admin\ContactController;
use App\Http\Controllers\web\Museum\HomeController;
use App\Http\Controllers\web\Museum\NavbarController;
use App\Http\Controllers\web\Museum\UserController;

use App\Http\Controllers\web\Pyramids\AboutController;


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

Route::prefix('GEM')->name('gem.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/navbar', [NavbarController::class, 'index'])->name('navbar.index');

    Route::get('/events', [EventController::class, 'gemEvents'])->name('events');

    Route::get('/{event}/events', [EventController::class, 'gemEventsShow'])->name('events.show');

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

    Route::get('/about-us', [MuseumAboutController::class, 'index'])->name('about');

    Route::prefix('tickets')->name('tickets.')->controller(TicketController::class)->group(function () {
        Route::get('/', 'gemTickets')->name('index');
        Route::post('/selections', 'storeSelections')->name('storeSelections');
        Route::get('/plan-visit', 'gemPlanVisit')->name('plan-visit');
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

    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs');
});


Route::prefix('Pyramids')->name('pyramids.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/events', [EventController::class, 'pyramidsEvents'])->name('events');

    Route::get('/memberships', [MembershipController::class, 'pyramidsMemberships'])->name('memberships');

    Route::get('/about-us', [AboutController::class, 'pyramidsAbout'])->name('about');

    Route::get('/collections', [CollectionController::class, 'pyramidsCollections'])->name('collections');

    Route::get('/shop', [ShopController::class, 'pyramidsShop'])->name('shops');

    Route::get('/tickets', [TicketController::class, 'pyramidsTickets'])->name('tickets');

});

// Route::prefix('admin')->middleware(['admin'])->group(function () {

//     Route::resources([
//         'admins'=> AdminController::class,
//         'roles' => RoleController::class,
//         'memberships' => MembershipController::class,
//         'gift-shops' => GiftShopController::class,
//         'careers' => CareerController::class,
//         'events' => EventController::class,
//         'donations' => DonationController::class,
//         'contracts' => ContractController::class,
//         'faqs' => FaqController::class,
//         'features' => FeatureController::class,
//         'places' => PlaceController::class,
//         'sales' => SaleController::class,
//         'stations' => StationController::class,
//         'visitor-types' => VisitorTypesController::class,
//         'transportaions' => TransportationController::class,
//     ]);
    
// });