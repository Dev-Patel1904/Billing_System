<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;



//Login
Route::get('/', function () {return view('product.welcome');});
Route::post('/admin/login', [AdminLogin::class, 'login'])->name('admin.login.submit');

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




Route::get('/billing-list', function () {
    return view('billing.billing_list');
})->name('billing-list');

Route::get('/new-billing', function () {
    return view('billing.new-billing');
})->name('new-billing');

Route::get('/customer_list', function () {
    return view('list.customer_list');
})->name('customer_list');

Route::get('/supplier_list', function () {
    return view('list.supplier_list');
})->name('supplier_list');





Route::get('/sales', function () {
    return view('sales.sales');
})->name('sales');

Route::get('/show_sales', function () {
    return view('sales.show_sales');
})->name('show_sales');
