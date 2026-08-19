<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SpllierlistController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\Customer_listController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TypeController;

//Login
Route::get('/', function () {
    return view('product.welcome');
})->name('admin.login');
Route::post('/admin/login', [AdminLogin::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [AdminLogin::class, 'logout'])->name('admin.logout');

// Forgot / Reset Password
Route::get('/forgot-password', [ForgotPassController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password/send-otp', [ForgotPassController::class, 'sendOtp'])->name('forgot.password.send-otp');

Route::get('/reset-password', [ForgotPassController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password/verify-otp', [ForgotPassController::class, 'verifyOtp'])->name('reset.password.verify-otp');
Route::post('/reset-password/verify', [ForgotPassController::class, 'resetPassword'])->name('reset.password.verify');
Route::post('/reset-password/resend-otp', [ForgotPassController::class, 'resendOtp'])->name('reset.password.resend-otp');

Route::get('/test-gujarati-pdf', function () {
    return view('billing.pdf');
});
Route::get('/billing/pdf/{bill}', [BillingController::class, 'pdf'])
    ->name('billing.pdf');

Route::middleware('admin.auth')->group(function () {

    //Index
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    //add_new_Product
    Route::get('/add_product', [SupplierController::class, 'add_product'])->name('add_product');
    Route::post('/suppliers/store', [SupplierController::class, 'store'])->name('suppliers.store');

    //purchase
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
    Route::post('/purchases/store', [PurchaseController::class, 'store'])->name('purchases.store');
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    Route::get('/purchase_detail/{purchase}', [PurchaseController::class, 'purchase_detail'])->name('purchase_detail');
    Route::put('/purchases/{purchase}/update-payment', [PurchaseController::class, 'updatePayment'])->name('purchases.update_payment');
    Route::get('/purchase/{purchase}/pdf', [PurchaseController::class, 'pdf'])->name('purchase.pdf');

    //supplier-list
    Route::get('/supplier_list', [SpllierlistController::class, 'supplier_list'])->name('supplier_list');
    Route::put('/suppliers/{supplier}', [SpllierlistController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SpllierlistController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/supplier/{supplier}/purchases', [SpllierlistController::class, 'supplierPurchases'])->name('supplier.purchases');
    Route::post('/supplier/pay-due', [SpllierlistController::class, 'payDue'])->name('supplier.pay-due');

    //setting
    Route::get('/settings', [AdminLogin::class, 'settings'])->name('settings');
    Route::put('/settings/update-password', [AdminLogin::class, 'updatePassword'])->name('settings.update_password');

    //New Billing
    Route::get('/billing/new', [BillingController::class, 'create'])->name('billing.create');
    Route::post('/billing/pay-due', [BillingController::class, 'payDue'])->name('billing.pay-due');
    Route::post('/billing/check-customer', [BillingController::class, 'checkCustomer'])->name('billing.check-customer');
    Route::post('/billing/store', [BillingController::class, 'store'])->name('billing.store');
    Route::post('/billing/store-extra-product', [BillingController::class, 'storeExtraProduct'])->name('billing.store-extra-product');

    //Sales
    Route::get('/sales', [SaleController::class, 'sales'])->name('sales');
    Route::get('/show_sales/{bill}', function ($bill) {return view('sales.show_sales');})->name('show_sales');
    Route::get('/show_sales/{bill}', [SaleController::class, 'show_sales'])->name('show_sales');

    //type
    Route::post('/types/store', [TypeController::class, 'store'])->name('types.store');
    Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update');


    //Customer_list
    Route::get('/customer_list', [Customer_listController::class, 'customer_list'])->name('customer_list');
    Route::post('/customers/store', [Customer_listController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [Customer_listController::class, 'update'])->name('customers.update');
    Route::get('/customer/{customer}/bills', [Customer_listController::class, 'customerBills'])->name('customer.bills');
    //customer-particular bill show print
    Route::get('/billing/{bill}/print', [BillingController::class, 'printBill'])->name('billing.print');
});
