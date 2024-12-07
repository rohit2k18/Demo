<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('invoices', InvoiceController::class);

Route::get('/', function () {
    return view('welcome');
})->name('/');
Route::post('signup',[HomeController::class,'register'])->name('signup');
Route::post('login',[HomeController::class,'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    Route::get('logout',[HomeController::class,'logout'])->name('logout');

    Route::middleware(['can:isAdmin'])->group(function () {
        //Product routes
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::post('invoices/{invoice}/send-pdf', [InvoiceController::class, 'sendPdf'])->name('invoices.sendPdf');

        //Users routes
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('invoice/download/{id}', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('invoice/send/{id}', [InvoiceController::class, 'sendPdf'])->name('invoice.send');
    Route::get('/products/{id}/items', [ProductController::class, 'getProductItems'])->name('products.items');
    


});