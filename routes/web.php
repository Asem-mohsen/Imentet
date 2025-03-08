<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\Auth\LogoutController;

use App\Http\Controllers\web\Admin\AdminController;
use App\Http\Controllers\web\Admin\CareerController;
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
use App\Http\Controllers\web\Museum\HomeController;
use App\Http\Controllers\web\Museum\UserController;

use App\Http\Controllers\web\Pyramids\AboutController;


Route::prefix('auth')->middleware(['auth:web'])->group(function () {
    Route::prefix('logout')->group(function () {
        Route::post('/current', [LogoutController::class, 'logoutFromCurrentSession'])->name('auth.logout.current');
        Route::post('/all', [LogoutController::class, 'logoutFromAllSessions'])->name('auth.logout.all');
        Route::post('/others', [LogoutController::class, 'logoutFromOtherSessions'])->name('auth.logout.others');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile.index');
        Route::get('/edit', [UserController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [UserController::class, 'update'])->name('profile.update');
        Route::delete('/delete', [UserController::class, 'destroy'])->name('profile.delete');
    });
});


Route::prefix('GEM')->name('gem.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/events', [EventController::class, 'gemEvents'])->name('events');

    Route::get('/memberships', [MembershipController::class, 'gemMemberships'])->name('memberships');

    Route::get('/about-us', [MuseumAboutController::class, 'gymAbout'])->name('about');

    Route::get('/collections', [CollectionController::class, 'gymCollections'])->name('collections');

    Route::get('/shop', [ShopController::class, 'gymShop'])->name('shops');

    Route::get('/tickets', [TicketController::class, 'gymTickets'])->name('tickets');
});


Route::prefix('Pyramids')->name('pyramids.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/events', [EventController::class, 'pyramidsEvents'])->name('events');

    Route::get('/memberships', [MembershipController::class, 'pyramidsMemberships'])->name('memberships');

    Route::get('/about-us', [AboutController::class, 'pyramidsAbout'])->name('about');

    Route::get('/collections', [CollectionController::class, 'pyramidsCollections'])->name('collections');

    Route::get('/shop', [ShopController::class, 'pyramidsShop'])->name('shops');

    Route::get('/tickets', [TicketController::class, 'pyramidsTickets'])->name('tickets');

});

Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::resources([
        'admins'=> AdminController::class,
        'roles' => RoleController::class,
        'memberships' => MembershipController::class,
        'gift-shops' => GiftShopController::class,
        'careers' => CareerController::class,
        'events' => EventController::class,
        'donations' => DonationController::class,
        'contracts' => ContractController::class,
        'faqs' => FaqController::class,
        'features' => FeatureController::class,
        'places' => PlaceController::class,
        'sales' => SaleController::class,
        'stations' => StationController::class,
        'visitor-types' => VisitorTypesController::class,
        'transportaions' => TransportationController::class,
    ]);
    
});