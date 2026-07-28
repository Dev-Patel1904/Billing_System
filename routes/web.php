<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('product.welcome');
});

Route::get('/dashboard', function () {
    return view('product.dashboard');
})->name('dashboard');

Route::get('/add_product', function () {
    return view('product.add_new_product');
})->name('add_product');

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

Route::get('/purchase_detail', function () {
    return view('purchase.purchase_detail');
});

Route::get('/purchase', function () {
    return view('purchase.purchase');
})->name('purchase');

Route::get('/sales', function () {
    return view('sales.sales');
})->name('sales');

Route::get('/show_sales', function () {
    return view('sales.show_sales');
})->name('show_sales');
