<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{category}', [AdminController::class, 'delete_category']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/delete_product/{product}', [AdminController::class, 'delete_product']);
Route::get('/update_product/{product}', [AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{product}', [AdminController::class, 'update_product_confirm']);
Route::get('/product_details/{product}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{product}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_cart/{cart}', [HomeController::class, 'remove_cart']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);
Route::get('/stripe/{totalPrice}', [HomeController::class, 'stripe']);
Route::post('/stripe/{totalPrice}', [HomeController::class, 'stripePost'])->name('stripe.post');
Route::get('/order', [AdminController::class, 'order']);
Route::get('/delivered/{order}', [AdminController::class, 'delivered']);
Route::get('/print_pdf/{order}', [AdminController::class, 'print_pdf']);
Route::get('/send_email/{order}', [AdminController::class, 'send_email']);
Route::post('/send_user_email/{order}', [AdminController::class, 'send_user_email']);
Route::post('/search', [AdminController::class, 'searchData']);
