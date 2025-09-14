<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\User\HomeController@index')->name('home');

Route::prefix('products')->group(function () {
    Route::get('/', 'App\Http\Controllers\User\ProductController@index')->name('products.index');
    Route::get('/{id}', 'App\Http\Controllers\User\ProductController@show')->where('id', '[0-9]+')->name('products.show');
});
