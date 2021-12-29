<?php

use Illuminate\Support\Facades\Route;

include_once "auth-api.php";

Route::middleware(['verified'])->group(function (){

});