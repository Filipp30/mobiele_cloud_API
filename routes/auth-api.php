<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//AUTH: Authentication and Authorization routes.
Route::post('/create-new-account',[AuthController::class,'createNewAccount']);

Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])
    ->middleware(['signed','email.verification'])
    ->name('verification.verify');

Route::get('/email/verification-notification/{id}',[AuthController::class,'emailVerification'])
    ->name('verification.send');

Route::post('/login',[AuthController::class,'login'])->middleware('verified');

Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum','verified']);
