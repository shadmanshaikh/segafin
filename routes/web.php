<?php

use App\Http\Controllers\home;
use Livewire\Volt\Volt;

// Remove or comment out the old route
Route::get('/', [home::class, 'index']);
Route::get('/login', [home::class, 'login']);
Route::get('/logout', [home::class, 'logout']);


Volt::route('/users', 'users.index');
// dashboard
Volt::route('/dashboard', 'dashboard')->middleware('auth');
// stock statement
Volt::route('/stock-stats', 'features.stockinfo.stockstats');


// make invoice
Volt::route('/invoice/make-invoice', 'features.invoice.make-invoice');
// invoice list
Volt::route('/invoice/invoice-list', 'features.invoice.invoicelist');
Volt::route('/invoice/sales-invoice', 'features.invoice.salesinvoicelist');

// soa
Volt::route('/soa/soa', 'features.soa.soa');

// settings
Volt::route('/settings' , 'settings');


// dynamic routes
Volt::route('/invoice/{invoice_number}' , 'features.invoice.singleinvoice');

Volt::route('/customer/{customer_name}' , 'features.customer.customer')->name('features.customerlist');