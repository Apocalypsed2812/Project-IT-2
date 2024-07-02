<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/account', [App\Http\Controllers\AccountController::class, 'getAccount']);
