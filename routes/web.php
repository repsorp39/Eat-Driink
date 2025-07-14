<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\WaitingBusinessController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get("/stand-request", [StandController::class,'serve'])->name("stand-form");

Route::post("/stand",[RegisterController::class,"standRequest"])->name("stand-request");

Route::controller(LoginController::class)->prefix('/login')->group(
    function(){
        Route::post("/","login")->name("login-post");
        Route::get("/","serve")->name("login");
        Route::get("/logout","logout")->name("logout");
    }
);

Route::get("/request-status",[WaitingBusinessController::class,'serve'])->name("status");
