<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\InstallmentController as ClientInstallmentController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\InstallmentController as CustomerInstallmentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\InstallmentController as AdminInstallmentController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\StockAlertController;
// ===================== الصفحات العامة =====================
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/stores', [PublicController::class, 'stores'])->name('public.stores');
Route::get('/how-it-works', [PublicController::class, 'howItWorks'])->name('public.how-it-works');
Route::get('/business', [PublicController::class, 'business'])->name('public.business');
Route::get('/user', [PublicController::class, 'user'])->name('public.user');
Route::get('/help', [PublicController::class, 'help'])->name('public.help');

// ===================== مسارات المصادقة (Breeze) =====================
require __DIR__ . '/auth.php';

// ===================== مسارات المستخدم العادي (بعد تسجيل الدخول) =====================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ create قبل {store} - مهم جداً
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    Route::post('/store', [StoreController::class, 'store'])->name('store.store');
});

// ===================== مسارات العميل (العامة) =====================
Route::get('/products', [ClientProductController::class, 'index'])->name('client.products.index');
Route::get('/products/{slug}', [ClientProductController::class, 'show'])->name('client.products.show');

// ✅ هنا بعد middleware group عشان {store} ما يلتقط create
Route::get('/store/{store}', [StoreController::class, 'show'])->name('client.stores.show');

// ===================== مسارات السلة (للجميع) =====================
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// ===================== مسارات إتمام الطلب =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::post('/installment/{installment}/pay', [ClientInstallmentController::class, 'pay'])
        ->name('installment.pay');
});

// ===================== مسارات العميل (خاصة) =====================
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
    Route::get('/profile', [CustomerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');
    Route::get('/installments', [CustomerInstallmentController::class, 'index'])->name('installments.index');
});

// ===================== مسارات البائع (Seller) =====================
Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/products', ProductController::class)->except(['show']);

    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [SellerOrderController::class, 'updateStatus'])->name('orders.update-status');

    Route::get('/profile', [SellerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SellerProfileController::class, 'update'])->name('profile.update');

    Route::get('stock-alerts', [StockAlertController::class, 'index'])->name('stock.alerts');
});

// ===================== مسارات المشرف (Admin) =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/stores', [AdminStoreController::class, 'index'])->name('stores.index');
    Route::get('/stores/{store}', [AdminStoreController::class, 'show'])->name('stores.show');
    Route::patch('/stores/{store}/status', [AdminStoreController::class, 'updateStatus'])->name('stores.update-status');
    Route::patch('/stores/{store}/toggle', [AdminStoreController::class, 'toggleStatus'])->name('stores.toggle');
    Route::delete('/stores/{store}', [AdminStoreController::class, 'destroy'])->name('stores.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    Route::get('/installments', [AdminInstallmentController::class, 'index'])->name('installments.index');
    Route::get('/installments/{installment}', [AdminInstallmentController::class, 'show'])->name('installments.show');
    Route::patch('/installments/{installment}/status', [AdminInstallmentController::class, 'updateStatus'])->name('installments.update-status');
});

Route::name('public.')->group(function () {
    Route::get('/store/{id}', [StoreController::class, 'show'])->name('store-page');
});