<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (auth()->check()) {
        // If user is logged in, redirect to dashboard
        return redirect()->route('dashboard');
    }
    // If not logged in, show login page
    return view('auth.login');
})->name('home');

// Admin Routes (no prefix)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->middleware('role:super-admin|admin')
        ->name('dashboard');

    // User management
    Route::middleware('access:create users')->group(function () {
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware('access:view users')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    });
    Route::middleware('access:edit users')->group(function () {
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware('access:delete users')->group(function () {
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Product management
    Route::middleware('access:view products')->group(function () {
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    });
    Route::middleware('access:create products')->group(function () {
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
    });
    Route::middleware('access:edit products')->group(function () {
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    });
    Route::middleware('access:delete products')->group(function () {
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Category management
    Route::middleware('access:view categories')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    });
    Route::middleware('access:create categories')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    });
    Route::middleware('access:edit categories')->group(function () {
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    });
    Route::middleware('access:delete categories')->group(function () {
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Brand management
    Route::middleware('access:view brands')->group(function () {
        Route::get('brands', [BrandController::class, 'index'])->name('brands.index');
        Route::get('brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
    });
    Route::middleware('access:create brands')->group(function () {
        Route::get('brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('brands', [BrandController::class, 'store'])->name('brands.store');
    });
    Route::middleware('access:edit brands')->group(function () {
        Route::get('brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    });
    Route::middleware('access:delete brands')->group(function () {
        Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    });

    // Order management
    Route::middleware('access:view orders')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
    Route::middleware('access:create orders')->group(function () {
        Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    });
    Route::middleware('access:edit orders')->group(function () {
        Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    });
    Route::middleware('access:delete orders')->group(function () {
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });

    // Role management (only for super-admin)
    Route::middleware('role:super-admin')->prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [App\Http\Controllers\Admin\RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('edit');
        Route::put('/{role}', [App\Http\Controllers\Admin\RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('destroy');
    });

    // Settings management (only for super-admin)
    Route::middleware('role:super-admin')->prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
        Route::get('/general', [App\Http\Controllers\Admin\SettingController::class, 'general'])->name('general');
        Route::post('/general', [App\Http\Controllers\Admin\SettingController::class, 'updateGeneral'])->name('general.update');
        Route::get('/faqs', [App\Http\Controllers\Admin\SettingController::class, 'faqs'])->name('faqs');
        Route::post('/faqs', [App\Http\Controllers\Admin\SettingController::class, 'storeFaq'])->name('faqs.store');
        Route::put('/faqs/{key}', [App\Http\Controllers\Admin\SettingController::class, 'updateFaq'])->name('faqs.update');
        Route::delete('/faqs/{key}', [App\Http\Controllers\Admin\SettingController::class, 'destroyFaq'])->name('faqs.destroy');
        Route::get('/roles', [App\Http\Controllers\Admin\SettingController::class, 'roles'])->name('roles');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
