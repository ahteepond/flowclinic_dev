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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('index');


// Login -----------------------------------
Route::get('/login', 'LoginController@index')->name('login');



// Dashboard -----------------------------------
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');



// Employee -----------------------------------
Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/list', 'EmployeeController@list')->name('employee.list');
Route::get('/employee/new', 'EmployeeController@new')->name('employee.new');
Route::post('/employee/insert', 'EmployeeController@insert')->name('employee.insert');
Route::get('/employee/view/{empcode}', 'EmployeeController@view')->name('employee.view');
Route::get('/employee/edit/{empcode}', 'EmployeeController@edit')->name('employee.edit');
Route::post('/employee/update', 'EmployeeController@update')->name('employee.update');



// ServiceType -------------------------------
Route::get('/servicetype', 'ServiceTypeController@index')->name('servicetype');
Route::get('/servicetype/list', 'ServiceTypeController@list')->name('servicetype.list');
Route::get('/servicetype/new', 'ServiceTypeController@new')->name('servicetype.new');
Route::post('/servicetype/insert', 'ServiceTypeController@insert')->name('servicetype.insert');
Route::get('/servicetype/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');
Route::post('/servicetype/update', 'ServiceTypeController@update')->name('servicetype.update');



// Service -------------------------------
Route::get('/service', 'ServiceController@index')->name('service');
Route::get('/service/new', 'ServiceController@new')->name('service.new');
Route::get('/service/edit/{id}', 'ServiceController@edit')->name('service.edit');
Route::get('/service/view/{id}', 'ServiceController@view')->name('service.view');
Route::get('/service/list', 'ServiceController@list')->name('service.list');
Route::post('/service/getdata', 'ServiceController@getdata')->name('service.getdata');
Route::post('/service/update', 'ServiceController@update')->name('service.update');
Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');




// Payment Type -------------------------------
Route::get('/paymenttype', 'PaymentTypeController@index')->name('paymenttype');
Route::get('/paymenttype/new', 'PaymentTypeController@new')->name('paymenttype.new');
Route::get('/paymenttype/edit/{id}', 'PaymentTypeController@edit')->name('paymenttype.edit');
Route::get('/paymenttype/list', 'PaymentTypeController@list')->name('paymenttype.list');
Route::post('/paymenttype/update', 'PaymentTypeController@update')->name('paymenttype.update');
Route::post('/paymenttype/insert', 'PaymentTypeController@insert')->name('paymenttype.insert');



// Discount Type -------------------------------
Route::get('/discounttype', 'DiscountTypeController@index')->name('discounttype');
Route::get('/discounttype/new', 'DiscountTypeController@new')->name('discounttype.new');
Route::get('/discounttype/edit/{id}', 'DiscountTypeController@edit')->name('discounttype.edit');
Route::get('/discounttype/list', 'DiscountTypeController@list')->name('discounttype.list');
Route::post('/discounttype/update', 'DiscountTypeController@update')->name('discounttype.update');
Route::post('/discounttype/insert', 'DiscountTypeController@insert')->name('discounttype.insert');



// Customer Type -------------------------------
Route::get('/customertype', 'CustomerTypeController@index')->name('customertype');
Route::get('/customertype/new', 'CustomerTypeController@new')->name('customertype.new');
Route::get('/customertype/edit', 'CustomerTypeController@edit')->name('customertype.edit');
Route::get('/customertype/edit/{id}', 'CustomerTypeController@edit')->name('customertype.edit');
Route::get('/customertype/list', 'CustomerTypeController@list')->name('customertype.list');
Route::post('/customertype/update', 'CustomerTypeController@update')->name('customertype.update');
Route::post('/customertype/insert', 'CustomerTypeController@insert')->name('customertype.insert');



// Appointment -------------------------------
Route::get('/appointment', 'AppointmentController@index')->name('appointment');
Route::get('/appointment/new', 'AppointmentController@new')->name('appointment.new');
Route::get('/appointment/history', 'AppointmentController@history')->name('appointment.history');



// Orders -------------------------------
Route::get('/order', 'OrderController@index')->name('order');
Route::get('/order/new', 'OrderController@new')->name('order.new');
Route::get('/order/detail', 'OrderController@detail')->name('order.detail');



// Check Payment -------------------------------
Route::get('/checkpayment', 'CheckPaymentController@index')->name('checkpayment');
Route::get('/checkpayment/view', 'CheckPaymentController@view')->name('checkpayment.view');


// Admitted -------------------------------
Route::get('/admitted', 'AdmittedController@index')->name('admitted');
Route::get('/admitted/process', 'AdmittedController@process')->name('admitted.process');



// OPD -------------------------------
Route::get('/opd', 'OPDController@index')->name('opd');
Route::get('/opd/process', 'OPDController@process')->name('opd.process');
Route::get('/opd/history', 'OPDController@history')->name('opd.history');
