<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
 
// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
 
// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// ✅ FIX: slug ki jagah id use ho raha hai
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
 
// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/badge', function() {
    return response()->json(['count' => count(session()->get('cart', []))]);
})->name('cart.badge');
 
// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
 
// Profile (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
 
// Checkout (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order-success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});
 
// Admin Routes
Route::prefix('admin')->group(function () {
    // Login
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
 
    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
 
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
 
        // Products
        Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
 
        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
 
        // Order Items
        Route::get('/order-items', [OrderItemController::class, 'index'])->name('admin.order-items.index');
 
        // Users
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
 
        // Admins
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admin.admins.store');
        Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
        Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
        Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
    });
});
 
// Include Breeze Routes (if installed)
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}