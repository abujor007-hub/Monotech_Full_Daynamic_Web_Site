<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserOrderController;
use GuzzleHttp\Middleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit.user');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
          // Wishlist Routes
    Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])
        ->name('wishlist.toggle');

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist');
});

require __DIR__ . '/auth.php';

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('index', [PagesController::class, 'index'])->name('index');
Route::get('product', [PagesController::class, 'product'])->name('product');
Route::get('about', [PagesController::class, 'about'])->name('about');
Route::get('contact', [PagesController::class, 'contact'])->name('contact');
Route::get('product-details', [PagesController::class, 'productdetails'])->name('product-details');
Route::get('checkout', [PagesController::class, 'checkout'])->name('checkout');
Route::get('Login', [PagesController::class, 'Login'])->name('Login');
Route::get('index', [PagesController::class, 'index'])->name('index');


use App\Http\Controllers\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


use App\Http\Controllers\UserProfileController;

Route::middleware('auth')->group(function () {

    Route::get('/user-profile/edit', [UserProfileController::class, 'edit'])
        ->name('userprofile.edit');

    Route::put('/user-profile/update', [UserProfileController::class, 'update'])
        ->name('userprofile.update');

    Route::get('/change-password', [UserProfileController::class, 'changePassword'])
        ->name('userpassword.edit');

    Route::put('/change-password', [UserProfileController::class, 'updatePassword'])
        ->name('userpassword.update');

    // Delete Account
    Route::get('/delete-account', [UserProfileController::class, 'deleteAccount'])
        ->name('useraccount.delete');

    Route::delete('/delete-account', [UserProfileController::class, 'destroyAccount'])
        ->name('useraccount.destroy');
    Route::get('/profile-information', [UserProfileController::class, 'profileInfo'])
        ->name('userprofile.info');
});


use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SSLCommerzController;
use App\Http\Controllers\UserCartController;
use App\Http\Controllers\UserWishlistController;

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])
        ->name('admin.profile');

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');

         Route::get('/my-orders', [UserOrderController::class, 'index'])
        ->name('user.orders');

    Route::get('/my-orders/{id}', [UserOrderController::class, 'show'])
        ->name('user.orders.show');
         Route::get('/user-wishlist', [UserWishlistController::class, 'index'])
        ->name('user.wishlist');
         Route::get('/user-cart', [UserCartController::class, 'index'])
        ->name('user.cart');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/account-security', [AdminAccountController::class, 'index'])
        ->name('admin.account.security');

    Route::put('/admin/change-password', [AdminAccountController::class, 'updatePassword'])
        ->name('admin.password.update');

    Route::delete('/admin/delete-account', [AdminAccountController::class, 'destroy'])
        ->name('admin.account.delete');
});



// category start 

Route::get('category', [CategoryController::class, 'category'])->name('category');
Route::put('category-store', [CategoryController::class, 'store'])->name('category.store');
Route::delete('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


// product start 

Route::get('add-product', [ProductsController::class, 'product'])->name('add.product');
Route::put('product-store', [ProductsController::class, 'store'])->name('product.store');
Route::get('product-list', [ProductsController::class, 'list'])->name('product.list');
Route::get('product/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');

Route::put('product/{id}/update', [ProductsController::class, 'update'])->name('product.update');
Route::delete('product/{id}/', [ProductsController::class, 'destroy'])->name('product.destroy');
Route::get('/product-details/{slug}', [ProductsController::class, 'productDetails'])  ->name('product.details');

Route::get('/product/live-search', [ProductsController::class, 'liveSearch'])
    ->name('product.live.search');

    Route::get('/admin/out-of-stock-products', [ProductsController::class, 'outOfStockProducts'])
    ->name('product.outofstock');
Route::get('/admin/category-slider', [ProductsController::class, 'index'])
    ->name('admin.category-slider');    



// add to cart 


Route::post('/add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('cart.add');


Route::post('/cart/increase/{id}', [ProductsController::class, 'increaseCart'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [ProductsController::class, 'decreaseCart'])
    ->name('cart.decrease');
Route::get('/cart/remove/{id}', [ProductsController::class, 'removeCart'])
    ->name('cart.remove');


// order start 

Route::post('/checkout', [OrderController::class, 'store'])->name('order');
Route::get('/order-confirm/{id}', [OrderController::class, 'confirm'])
    ->name('order.confirm');

Route::get('order-list', [OrderController::class, 'OrderList']) ->name('order.list');
Route::get('order-details/{id}', [OrderController::class, 'OrderDetails'])->name('order.details');
Route::patch('/admin/orders/{id}/status', [OrderController::class, 'UpdateOrderStatus'])  ->name('admin.order.status.update');
Route::get('panding-orders',[OrderController::class,'pandingOrders'])->name('order.pending');
Route::get('processing-orders',[OrderController::class,'processingOrders'])->name('order.processing');
Route::get('delivered-orders',[OrderController::class,'deliveredOrders'])->name('order.delivered');
Route::get('cancelled-orders',[OrderController::class,'cancelledOrders'])->name('order.cancelled');
Route::get('shipped-orders',[OrderController::class,'shippedOrders'])->name('order.shipped');

Route::get('/sslcommerz/pay/{orderId}', [
    SSLCommerzController::class,
    'pay'
])->name('sslcommerz.pay');


Route::post('/sslcommerz/success', [
    SSLCommerzController::class,
    'success'
])->name('sslcommerz.success');


Route::post('/sslcommerz/fail', [
    SSLCommerzController::class,
    'fail'
])->name('sslcommerz.fail');


Route::post('/sslcommerz/cancel', [
    SSLCommerzController::class,
    'cancel'
])->name('sslcommerz.cancel');


Route::post('/sslcommerz/ipn', [
    SSLCommerzController::class,
    'ipn'
])->name('sslcommerz.ipn');

Route::get('messages', [ContactController::class, 'index'])
    ->name('admin.messages');
Route::post('/contact/store', [ContactController::class, 'store'])
    ->name('contact.store');
Route::delete('/user/messages/{id}', [ContactController::class, 'destroy'])
    ->name('user.messages.delete');
Route::get('/user/messages/{id}', [ContactController::class, 'show'])
    ->name('user.messages.show');

Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users');

    Route::get('/admin/users/{id}', [UserController::class, 'show'])
        ->name('admin.users.show');    
