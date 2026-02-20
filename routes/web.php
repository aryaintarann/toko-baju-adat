<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public Routes (No Login Required)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// API Routes (for AJAX)
Route::get('/api/regions/search', [App\Http\Controllers\Api\RegionController::class, 'search'])->name('api.regions.search');
Route::post('/api/shipping/cost', App\Http\Controllers\Api\ShippingController::class)->name('api.shipping.cost');
Route::post('/api/payment/notification', [App\Http\Controllers\Api\PaymentCallbackController::class, 'handle'])->name('api.payment.notification');

// Refund Routes
Route::get('/refund-policy', [\App\Http\Controllers\RefundController::class, 'policy'])->name('refund.policy');
Route::get('/refund', [\App\Http\Controllers\RefundController::class, 'create'])->name('refund.create');
Route::post('/refund', [\App\Http\Controllers\RefundController::class, 'store'])->name('refund.store');

// Admin Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::prefix('admin')->middleware(AdminMiddleware::class)->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/refunds', [\App\Http\Controllers\Admin\RefundController::class, 'index'])->name('refunds.index');
    Route::post('/refunds/{refund}/process', [\App\Http\Controllers\Admin\RefundController::class, 'process'])->name('refunds.process');
});
