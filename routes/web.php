<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\WaitingBusinessController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ApprovedUserMiddleware;
use App\Http\Middleware\standWaitingMiddleware;
use App\Models\Stand;
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

Route::get("/request-status",[WaitingBusinessController::class,'serve'])
    ->middleware([standWaitingMiddleware::class])
    ->name("status");

Route::controller(AdminController::class)
    ->middleware(AdminMiddleware::class)
    ->prefix("/admin")
    ->group(function(){
        Route::get("/", "serve")->name("dashboard");
        Route::get("/reject/","rejectRequest")->name("reject");
        Route::get("/approved/","approvedRequest")->name("approved");
    });

Route::controller(ProductController::class)
    ->middleware(ApprovedUserMiddleware::class)
    ->prefix("/products")
    ->group(function(){
        Route::get("/","serve")->name("product");
        Route::get("/delete","delete")->name("product-delete");
        Route::get("/new","serveForm")->name("product-form");
        Route::get("/form-edit/{id}","serveFormEdit")->name("product-edit");
        Route::post("/edit/new","create")->name("new-product");
        Route::post("/update","update")->name("product-update");
    });


Route::controller(VisitorController::class)
    ->group(function(){
        Route::get("/stands", "serve")->name("stand");
        Route::get("/stands/{id}", "serveDetails")->name("stand-info");
        Route::get("/product-info","getCardProductInfo");
    });

Route::post("/order",[OrderController::class,"order"]);

Route::middleware(ApprovedUserMiddleware::class)
      ->get("/orders",[OrderController::class,"serveOrder"])->name("orders");
