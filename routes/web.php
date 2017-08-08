<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'api' ], function() {
    Route::resource('customers','CustomersController');
    Route::resource('employees','EmployeesController');
    Route::resource('settings','SettingsController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('bills', 'BillsController');
    Route::resource('billdetails', 'BillDetailsController');
    Route::resource('certificates', 'CertificatesController');
    Route::resource('notifications', 'NotificationsController');
    Route::resource('orderdetails', 'OrderDetailsController');
    Route::resource('trades', 'TradesController');
    Route::resource('payments', 'PaymentsController');
    Route::resource('payment_bills', 'PaymentBillsController');
    Route::resource('calendar', 'CalendarController');
    Route::resource('events','EventsController');
    Route::resource('messages', 'MessagesController');
    Route::resource('products', 'ProductsController');
});

Route::get('/', function () {
    return view('welcome');
});


