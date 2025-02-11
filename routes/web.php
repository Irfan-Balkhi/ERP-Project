<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceNumController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SupplierController;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\HRController;





// Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // Add name to the route

// Route::get('/dashboard', function () {
//     return view('dashboard');
//   }); //->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';

Route::group(['middleware' => ['role:Super Admin|Admin']], function()
{

    Route::resource('permission', App\Http\Controllers\PermissionController::class);
    Route::get('permission/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('role', App\Http\Controllers\RoleController::class);
    Route::get('role/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
        // ->middleware('permission:delete role');

    Route::get('role/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('role/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('user/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::resource('category', CategoryController::class);

    // Add this route for deactivation
    Route::patch('/categories/{id}/deactivate', [CategoryController::class, 'deactivate'])->name('categories.deactivate');

});






// Route::get('/', [HomepageController::class,'index'])->name('homepage');


Route::resource('invoice', InvoiceNumController::class);

Route::resource('purchase', PurchaseController::class);

Route::resource('inventory', InventoryController::class);

Route::resource('sale', SaleController::class);

Route::resource('transaction', TransactionController::class);

Route::resource('product', ProductController::class);

Route::resource('supplier', SupplierController::class);

// Create a route that fetches products by CategoryID:
Route::get('/get-products/{CategoryID}', [ProductController::class, 'getProductsByCategory']);

Route::get('/get-products/{CategoryID}', [PurchaseController::class, 'getProductsByCategory']);

// Update finance data manually
Route::get('/finances/update', [FinanceController::class, 'updateFinanceData']);

// Resource routes for Finance (for CRUD operations)
Route::resource('finance', FinanceController::class);
//related to the finance cards:
Route::get('/finance/purchases', [FinanceController::class, 'showPurchases'])->name('finance.purchases');
Route::get('/finance/sales', [FinanceController::class, 'showSales'])->name('finance.sales');
Route::get('/finance/transactions', [FinanceController::class, 'showTransactions'])->name('finance.transactions');
Route::get('/finance/expenses', [FinanceController::class, 'showExpenses'])->name('finance.expenses');

// Resource routes for Expenses (for CRUD operations)
Route::resource('expense', ExpenseController::class);

// Grouping routes for PurchaseController
// Route::prefix('purchase')->name('purchase.')->group(function () {
//     Route::get('/', [PurchaseController::class, 'index'])->name('index'); // Purchase index route
//     Route::get('/create', [PurchaseController::class, 'create'])->name('create'); // Purchase create route
//     Route::post('/', [PurchaseController::class, 'store'])->name('store'); // Purchase store route
//     // Add more routes related to PurchaseController as needed
// });
