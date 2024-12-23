<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceNumController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/', [HomepageController::class,'index'])->name('homepage');

Route::resource('category', CategoryController::class);

// Add this route for deactivation
Route::patch('/categories/{id}/deactivate', [CategoryController::class, 'deactivate'])->name('categories.deactivate');

Route::resource('invoice', InvoiceNumController::class);

Route::resource('purchase', PurchaseController::class);

Route::resource('sale', SaleController::class);

Route::resource('transaction', TransactionController::class);

Route::resource('product', ProductController::class);

// Grouping routes for PurchaseController
// Route::prefix('purchase')->name('purchase.')->group(function () {
//     Route::get('/', [PurchaseController::class, 'index'])->name('index'); // Purchase index route
//     Route::get('/create', [PurchaseController::class, 'create'])->name('create'); // Purchase create route
//     Route::post('/', [PurchaseController::class, 'store'])->name('store'); // Purchase store route
//     // Add more routes related to PurchaseController as needed
// });
