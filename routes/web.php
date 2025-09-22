<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'App\Http\Controllers\User\HomeController@index')->name('home');

Route::prefix('products')->group(function (): void {
    Route::get('/', 'App\Http\Controllers\User\ProductController@index')->name('products');
    Route::get('/{id}', 'App\Http\Controllers\User\ProductController@show')->where('id', '[0-9]+')->name('products.show');
    Route::post('/{id}/reviews', 'App\Http\Controllers\User\ReviewController@store')->where('id', '[0-9]+')->name('products.reviews.store');
    Route::get('/{id}/more-info', 'App\Http\Controllers\User\ProductController@moreInfo')->where('id', '[0-9]+')->name('products.moreInfo');
    Route::get('/top-3', 'App\Http\Controllers\User\ProductController@ranking')->name('user.products.ranking');
});

Route::prefix('cart')->middleware('auth')->group(function (): void {
    Route::get('/', 'App\Http\Controllers\User\CartController@index')->name('cart');
    Route::post('/add/{id}', 'App\Http\Controllers\User\CartController@add')->where('id', '[0-9]+')->name('cart.add');
    Route::delete('/', 'App\Http\Controllers\User\CartController@removeAll')->name('cart.removeAll');
    Route::delete('/{id}', 'App\Http\Controllers\User\CartController@remove')->where('id', '[0-9]+')->name('cart.remove');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', 'App\Http\Controllers\Admin\AdminDashboardController@index')->name('admin.dashboard');

    // Users management routes
    Route::prefix('users')->group(function (): void {
        Route::get('/', 'App\Http\Controllers\Admin\AdminUserController@index')->name('admin.users');
        Route::get('/create', 'App\Http\Controllers\Admin\AdminUserController@create')->name('admin.users.create');
        Route::post('/', 'App\Http\Controllers\Admin\AdminUserController@store')->name('admin.users.store');
        Route::get('/{user}/edit', 'App\Http\Controllers\Admin\AdminUserController@edit')->name('admin.users.edit');
        Route::put('/{user}', 'App\Http\Controllers\Admin\AdminUserController@update')->name('admin.users.update');
        Route::delete('/{user}', 'App\Http\Controllers\Admin\AdminUserController@destroy')->name('admin.users.destroy');
    });

    // Products management routes
    Route::prefix('products')->group(function (): void {
        Route::get('/', 'App\Http\Controllers\Admin\AdminProductController@index')->name('admin.products');
        Route::get('/create', 'App\Http\Controllers\Admin\AdminProductController@create')->name('admin.products.create');
        Route::post('/', 'App\Http\Controllers\Admin\AdminProductController@store')->name('admin.products.store');
        Route::get('/{product}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name('admin.products.edit');
        Route::put('/{product}', 'App\Http\Controllers\Admin\AdminProductController@update')->name('admin.products.update');
        Route::delete('/{product}', 'App\Http\Controllers\Admin\AdminProductController@destroy')->name('admin.products.destroy');
    });
});

Route::prefix('checkout')->middleware('auth')->group(function (): void {
    Route::get('/', 'App\Http\Controllers\User\CheckoutController@index')->name('checkout');
});

Route::prefix('orders')->middleware('auth')->group(function (): void {
    Route::get('/', 'App\Http\Controllers\User\OrderController@index')->name('orders');
    Route::get('/{order}', 'App\Http\Controllers\User\OrderController@show')->where('order', '[0-9]+')->name('orders.show');
});
