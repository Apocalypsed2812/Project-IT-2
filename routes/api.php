<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('show-qrcode', [App\Http\Controllers\AuthController::class, 'showQRCode']);
Route::post('confirm-otp', [App\Http\Controllers\AuthController::class, 'confirmOTP']);