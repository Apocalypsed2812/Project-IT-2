<?php

use Illuminate\Support\Facades\Route;

// Account
Route::get('get-list-account', [App\Http\Controllers\AccountController::class, 'getListAccount']);
Route::post('add-account', [App\Http\Controllers\AccountController::class, 'addAccount']);
Route::delete('delete-account/{id}', [App\Http\Controllers\AccountController::class, 'deleteAccount']);
Route::put('update-account/{id}', [App\Http\Controllers\AccountController::class, 'updateAccount']);
Route::post('update-account', [App\Http\Controllers\AccountController::class, 'updateAccountPost']);

// Product
Route::get('get-list-product', [App\Http\Controllers\ProductController::class, 'getListProduct']);
Route::get('get-product-by-id', [App\Http\Controllers\ProductController::class, 'getProductById']);
Route::post('add-product', [App\Http\Controllers\ProductController::class, 'addProduct']);
Route::delete('delete-product/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct']);
Route::put('update-product/{id}', [App\Http\Controllers\ProductController::class, 'updateProduct']);
Route::post('update-product', [App\Http\Controllers\ProductController::class, 'updateProductPost']);