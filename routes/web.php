<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'App\Http\Controllers\User\HomeController@index')->name('home');

Route::prefix('products')->group(function (): void {
    Route::get('/', 'App\Http\Controllers\User\ProductController@index')->name('products.index');
    Route::get('/{id}', 'App\Http\Controllers\User\ProductController@show')->where('id', '[0-9]+')->name('products.show');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard');
});
