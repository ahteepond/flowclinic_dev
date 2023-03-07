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


Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('index');


// Login -----------------------------------
Route::get('/login', 'LoginController@index')->name('login');
Route::post('/checklogin', 'LoginController@checklogin')->name('checklogin');
Route::get('/changepassword', 'LoginController@changePassword')->name('changepassword');
Route::post('/updatepassword', 'LoginController@updatePassword')->name('updatepassword');
Route::get('/logout', 'LoginController@logout')->name('logout');


// Dashboard -----------------------------------
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


// Employee -----------------------------------
Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/list', 'EmployeeController@list')->name('employee.list');
Route::get('/employee/new', 'EmployeeController@new')->name('employee.new');
Route::post('/employee/insert', 'EmployeeController@insert')->name('employee.insert');
Route::post('/employee/generate/empcode', 'EmployeeController@generateEmpcode')->name('employee.generate.empcode');
Route::get('/employee/view/{empcode}', 'EmployeeController@view')->name('employee.view');
Route::get('/employee/edit/{empcode}', 'EmployeeController@edit')->name('employee.edit');
Route::post('/employee/update', 'EmployeeController@update')->name('employee.update');


// User -----------------------------------
Route::post('/user/resetpassword', 'UserController@resetpassword')->name('user.resetpassword');
Route::get('/user/info', 'UserController@info')->name('user.info');
Route::post('/user/updateimgprofile', 'UserController@updateimgprofile')->name('user.updateimgprofile');


// ServiceType -------------------------------
Route::get('/servicetype', 'ServiceTypeController@index')->name('servicetype');
Route::get('/servicetype/list', 'ServiceTypeController@list')->name('servicetype.list');
Route::get('/servicetype/new', 'ServiceTypeController@new')->name('servicetype.new');
Route::post('/servicetype/insert', 'ServiceTypeController@insert')->name('servicetype.insert');
Route::get('/servicetype/edit/{id}', 'ServiceTypeController@edit')->name('servicetype.edit');
Route::post('/servicetype/update', 'ServiceTypeController@update')->name('servicetype.update');



// ServiceMaster -------------------------------
Route::get('/servicemaster', 'ServiceMasterController@index')->name('servicemaster');
Route::get('/servicemaster/list', 'ServiceMasterController@list')->name('servicemaster.list');
Route::get('/servicemaster/new', 'ServiceMasterController@new')->name('servicemaster.new');
Route::post('/servicemaster/insert', 'ServiceMasterController@insert')->name('servicemaster.insert');
Route::get('/servicemaster/edit/{id}', 'ServiceMasterController@edit')->name('servicemaster.edit');
Route::post('/servicemaster/update', 'ServiceMasterController@update')->name('servicemaster.update');
Route::post('/servicemaster/getdata', 'ServiceMasterController@getdata')->name('servicemaster.getdata');


// Service -------------------------------
Route::get('/service', 'ServiceController@index')->name('service');
Route::get('/service/new', 'ServiceController@new')->name('service.new');
Route::get('/service/edit/{id}', 'ServiceController@edit')->name('service.edit');
Route::get('/service/view/{id}', 'ServiceController@view')->name('service.view');
Route::get('/service/list', 'ServiceController@list')->name('service.list');
Route::post('/service/getdata', 'ServiceController@getdata')->name('service.getdata');
Route::post('/service/update', 'ServiceController@update')->name('service.update');
Route::post('/service/insert', 'ServiceController@insert')->name('service.insert');


// Payment -------------------------------
Route::post('/payment/insert', 'PaymentController@insert')->name('payment.insert');
Route::post('/payment/list', 'PaymentController@list')->name('payment.list');
Route::post('/payment/getdata', 'PaymentController@getdata')->name('payment.getdata');
Route::post('/payment/update', 'PaymentController@update')->name('payment.update');
Route::post('/payment/cancle', 'PaymentController@cancle')->name('payment.cancle');
Route::post('/payment/upload', 'PaymentController@upload')->name('payment.upload');
Route::post('/payment/resend', 'PaymentController@resend')->name('payment.resend');
Route::post('/payment/disapprove', 'PaymentController@disapprove')->name('payment.disapprove');
Route::post('/payment/approve', 'PaymentController@approve')->name('payment.approve');


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


// Customer -------------------------------
Route::get('/customer', 'CustomerController@index')->name('customer');
Route::get('/customer/list', 'CustomerController@list')->name('customer.list');
Route::get('/customer/new', 'CustomerController@new')->name('customer.new');
Route::post('/customer/insert', 'CustomerController@insert')->name('customer.insert');
Route::get('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update', 'CustomerController@update')->name('customer.update');
Route::post('/customer/getdata', 'CustomerController@getdata')->name('customer.getdata');
// -------------------------
Route::post('/customer/insert', 'CustomerController@insert')->name('customer.insert');
Route::post('/customer/getdatacusttype', 'CustomerController@getdatacusttype')->name('customer.getdatacusttype');




// Customer Type -------------------------------
Route::get('/customertype', 'CustomerTypeController@index')->name('customertype');
Route::get('/customertype/new', 'CustomerTypeController@new')->name('customertype.new');
Route::get('/customertype/edit/{id}', 'CustomerTypeController@edit')->name('customertype.edit');
Route::get('/customertype/list', 'CustomerTypeController@list')->name('customertype.list');
Route::post('/customertype/update', 'CustomerTypeController@update')->name('customertype.update');
Route::post('/customertype/insert', 'CustomerTypeController@insert')->name('customertype.insert');



// Appointment -------------------------------
Route::get('/appointment', 'AppointmentController@index')->name('appointment');
Route::get('/appointment/new/{id}', 'AppointmentController@new')->name('appointment.new');
Route::get('/appointment/history', 'AppointmentController@history')->name('appointment.history');
Route::post('/appointment/searchorders', 'AppointmentController@searchorders')->name('appointment.searchorders');
Route::get('/appointment/orderlist', 'AppointmentController@orderlist')->name('appointment.orderlist');
Route::get('/appointment/servicelist', 'AppointmentController@servicelist')->name('appointment.servicelist');
Route::post('/appointment/insert', 'AppointmentController@insert')->name('appointment.insert');

// ****
Route::get('/appointment/checklist', 'AppointmentController@checklist')->name('appointment.checklist');
Route::get('/appointment/waittingadmit', 'AppointmentController@waittingadmit')->name('appointment.waittingadmit');
Route::post('/appointment/waittingadmit/getemplist', 'AppointmentController@getemplist')->name('appointment.waittingadmit.getemplist');
Route::get('/appointment/admitted', 'AppointmentController@admitted')->name('appointment.admitted');
// Route::get('/appointmentlist', 'AppointmentController@list')->name('appointmentlist');
// Route::get('/appointment/checkaptlist', 'AppointmentController@checkaptlist')->name('appointment.checkaptlist');
Route::get('/appointment/getaptlist', 'AppointmentController@getaptlist')->name('appointment.getaptlist');
Route::post('/appointment/getaptdetail', 'AppointmentController@getaptdetail')->name('appointment.getaptdetail');
Route::post('/appointment/updateaptdetail', 'AppointmentController@updateaptdetail')->name('appointment.updateaptdetail');




// Orders -------------------------------
Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/orders/new', 'OrdersController@new')->name('orders.new');
Route::get('/orders/list', 'OrdersController@list')->name('orders.list');
Route::get('/orders/detail/{ordercode}', 'OrdersController@detail')->name('orders.detail');
// Route::get('/orders/edit/{ordercode}', 'OrdersController@edit')->name('orders.edit');
Route::post('/orders/selectcustomer', 'OrdersController@selectcustomer')->name('orders.selectcustomer');
Route::post('/orders/searchcustomer', 'OrdersController@searchcustomer')->name('orders.searchcustomer');
Route::post('/orders/getdiscountlist', 'OrdersController@getdiscountlist')->name('orders.getdiscountlist');
Route::post('/orders/getempsale', 'OrdersController@getempsale')->name('orders.getempsale');
Route::post('/orders/insert', 'OrdersController@insert')->name('orders.insert');
Route::post('/orders/getevidence', 'OrdersController@getevidence')->name('orders.getevidence');
// Route::get('/orders/view/{id}', 'OrdersController@view')->name('orders.view');
Route::post('/orders/checkvoidpayment', 'OrdersController@checkvoidpayment')->name('orders.checkvoidpayment');
Route::post('/orders/void', 'OrdersController@void')->name('orders.void');




// Check Payment -------------------------------
Route::get('/checkpayment', 'CheckPaymentController@index')->name('checkpayment');
Route::get('/checkpayment/list', 'CheckPaymentController@checkpayment')->name('checkpayment.list');
Route::get('/checkpayment/list', 'CheckPaymentController@list')->name('checkpayment.list');
Route::get('/checkpayment/view/{paymentcode}', 'CheckPaymentController@view')->name('checkpayment.view');


// Admitted -------------------------------
Route::get('/admitted', 'AdmittedController@index')->name('admitted');
Route::get('/admitted/process', 'AdmittedController@process')->name('admitted.process');



// OPD -------------------------------
Route::get('/opd', 'OPDController@index')->name('opd');
Route::post('/opd/search', 'OPDController@search')->name('opd.search');
Route::get('/opd/list', 'OPDController@list')->name('opd.list');
Route::get('/opd/detail/{customercode}', 'OPDController@detail')->name('opd.detail');



// Report -------------------------------
Route::get('/report/customer', 'ReportController@customer')->name('report.customer');
Route::get('/report/customer/search', 'ReportController@customerSearch')->name('report.customer.search');
Route::get('/report/individualopd', 'ReportController@individualopd')->name('report.individualopd');
Route::get('/report/individualopd/search', 'ReportController@individualopdSearch')->name('report.individualopd.search');
Route::get('/report/productandservice', 'ReportController@productandservice')->name('report.productandservice');
Route::get('/report/productandservice/search', 'ReportController@productandserviceSearch')->name('report.productandservice.search');
Route::get('/report/dailysalesreceipt', 'ReportController@dailysalesreceipt')->name('report.dailysalesreceipt');
Route::get('/report/dailysalesproductandservice', 'ReportController@dailysalesproductandservice')->name('report.dailysalesproductandservice');