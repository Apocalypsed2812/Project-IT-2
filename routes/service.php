<?php

use Illuminate\Support\Facades\Route;

// Account
Route::get('get-list-account', [App\Http\Controllers\AccountController::class, 'getListAccount']);