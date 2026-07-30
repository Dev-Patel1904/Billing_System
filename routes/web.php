<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SpllierlistController;



//Login
Route::get('/', function () {return view('product.welcome');})->name('admin.login');
Route::post('/admin/login', [AdminLogin::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminLogin::class, 'logout'])->name('admin.logout');


Route::middleware('admin.auth')->group(function () {

    //Index
    Route::get('/dashboard', function () {
        return view('product.dashboard');
    })->name('dashboard');

    //add_new_Product
    Route::get('/add_product', [SupplierController::class, 'add_product'])->name('add_product');
    Route::post('/suppliers/store', [SupplierController::class, 'store'])->name('suppliers.store');

    //purchase
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
    Route::post('/purchases/store', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('/purchase_detail/{purchase}', [PurchaseController::class, 'purchase_detail'])->name('purchase_detail');
    Route::put('/purchases/{purchase}/update-payment', [PurchaseController::class, 'updatePayment'])->name('purchases.update_payment');

   //supplier-list
   Route::get('/supplier_list', [SpllierlistController::class, 'supplier_list'])->name('supplier_list');
   Route::put('/suppliers/{supplier}', [SpllierlistController::class, 'update'])->name('suppliers.update');
   Route::delete('/suppliers/{supplier}', [SpllierlistController::class, 'destroy'])->name('suppliers.destroy');
   Route::get('/supplier/{supplier}/purchases', [SpllierlistController::class, 'supplierPurchases'])->name('supplier.purchases');


    //setting
    Route::get('/settings', [AdminLogin::class, 'settings'])->name('settings');
    Route::put('/settings/update-password', [AdminLogin::class, 'updatePassword'])->name('settings.update_password');


    Route::get('/billing-list', function () {
        return view('billing.billing_list');
    })->name('billing-list');

    Route::get('/new-billing', function () {
        return view('billing.new-billing');
    })->name('new-billing');

    Route::get('/customer_list', function () {
        return view('list.customer_list');
    })->name('customer_list');

    Route::get('/sales', function () {
        return view('sales.sales');
    })->name('sales');

    Route::get('/show_sales', function () {
        return view('sales.show_sales');
    })->name('show_sales');

});
