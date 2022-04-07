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

Route::get('/login', 'LoginController@index')->name('login');

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
Route::get('/service/edit', 'ServiceController@edit')->name('service.edit');
Route::get('/service/view', 'ServiceController@view')->name('service.view');
// Route::get('/service/list', 'ServiceController@list')->name('service.list');

// Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');
// Route::get('/service/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');

// Route::post('/service/update', 'ServiceController@update')->name('service.update');


// Payment Type -------------------------------
Route::get('/paymenttype', 'PaymentTypeController@index')->name('paymenttype');
Route::get('/paymenttype/new', 'PaymentTypeController@new')->name('paymenttype.new');
Route::get('/paymenttype/edit', 'PaymentTypeController@edit')->name('paymenttype.edit');
// Route::get('/service/list', 'ServiceController@list')->name('service.list');
// Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');
// Route::get('/service/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');
// Route::post('/service/update', 'ServiceController@update')->name('service.update');


// Discount Type -------------------------------
Route::get('/discounttype', 'DiscountTypeController@index')->name('discounttype');
Route::get('/discounttype/new', 'DiscountTypeController@new')->name('discounttype.new');
Route::get('/discounttype/edit', 'DiscountTypeController@edit')->name('discounttype.edit');
// Route::get('/service/list', 'ServiceController@list')->name('service.list');
// Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');
// Route::get('/service/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');
// Route::post('/service/update', 'ServiceController@update')->name('service.update');


// Customer Type -------------------------------
Route::get('/customertype', 'CustomerTypeController@index')->name('customertype');
Route::get('/customertype/new', 'CustomerTypeController@new')->name('customertype.new');
Route::get('/customertype/edit', 'CustomerTypeController@edit')->name('customertype.edit');
// Route::get('/service/list', 'ServiceController@list')->name('service.list');
// Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');
// Route::get('/service/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');
// Route::post('/service/update', 'ServiceController@update')->name('service.update');


// Appointment -------------------------------
Route::get('/appointment', 'AppointmentController@index')->name('appointment');
Route::get('/appointment/new', 'AppointmentController@new')->name('appointment.new');


// Orders -------------------------------
Route::get('/order', 'OrderController@index')->name('order');
Route::get('/order/new', 'OrderController@new')->name('order.new');
Route::get('/order/detail', 'OrderController@detail')->name('order.detail');
