<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

//AUTH: Authentication and Authorization routes.
Route::post('/create-new-account',[AuthController::class,'createNewAccount']);

### Email Verification ###
Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])
    ->middleware(['signed','email.verification'])
    ->name('verification.verify');

Route::get('/email/verification-notification/{id}',[AuthController::class,'emailVerification'])
    ->name('verification.send');


