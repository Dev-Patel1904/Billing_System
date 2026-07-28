<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('product.welcome');
});

Route::get('/dashboard', function () {
    return view('product.dashboard');
});

Route::get('/billing-list', function () {
    return view('billing.billing_list');
});

Route::get('/new-billing', function () {
    return view('billing.new-billing');
});
