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

Route::group(['middleware' => ['guest']], function () {
  Route::get('/','Auth\LoginController@showLoginForm');
  Route::post('login','Auth\LoginController@login')->name('login');
});

Route::group(['middleware' => ['auth']], function () {
  Route::get('/main', function () {
      return view('content.content');
  })->name('main');

    Route::post('logout','Auth\LoginController@logout')->name('logout');

/*INICIO ADMIN*/
Route::group(['middleware' => ['Admin']], function () {
    Route::get('category','CategoryController@index');
    Route::post('category/store','CategoryController@store');
    Route::put('category/update','CategoryController@update');
    Route::put('category/desactivate','CategoryController@desactivate');
    Route::put('category/activate','CategoryController@activate');
    Route::get('category/selectCategory','CategoryController@selectCategory');

    Route::get('service','ServiceController@index');
    Route::get('service/new','ServiceController@indexNew');
    Route::get('service/progress','ServiceController@indexProgress');
    Route::get('service/arrange','ServiceController@indexInspArrange');
    Route::get('service/assign','ServiceController@indexInspAssigned');

    Route::post('service/store','ServiceController@store');
    Route::put('service/update','ServiceController@update');
    Route::put('service/updateAfter','ServiceController@updateAfter');
    Route::put('service/updateIstatus','ServiceController@updateIstatus');
    Route::put('service/updateIstatusInspectionDate','ServiceController@updateIstatusInspectionDate');
    Route::get('service/getFollowup','ServiceController@getFollowup');
    Route::put('service/cancel','ServiceController@cancelInspection');

    Route::get('followup/getFollowup','FollowupController@getFollowup');
    Route::post('followup/store','FollowupController@store');
    Route::put('followup/desactivate','FollowupController@desactivate');

    Route::get('cost','CosttypeController@index');
    Route::post('cost/store','CosttypeController@store');
    Route::put('cost/update','CosttypeController@update');
    Route::put('cost/desactivate','CosttypeController@desactivate');
    Route::put('cost/activate','CosttypeController@activate');
    Route::get('cost/selectCost','ForwarderController@selectCost');


    Route::get('forwarder','ForwarderController@index');
    Route::post('forwarder/store','ForwarderController@store');
    Route::put('forwarder/update','ForwarderController@update');
    Route::put('forwarder/desactivate','ForwarderController@desactivate');
    Route::put('forwarder/activate','ForwarderController@activate');
    Route::get('forwarder/selectForwarder','ForwarderController@selectForwarder');

    Route::get('customer','CustomerController@index');
    Route::post('customer/store','CustomerController@store');
    Route::put('customer/update','CustomerController@update');

    Route::get('supplier','SupplierController@index');
    Route::post('supplier/store','SupplierController@store');
    Route::put('supplier/update','SupplierController@update');

    Route::get('rol','RolController@index');
    Route::get('rol/selectRol','RolController@selectRol');

    Route::get('company','CompanyController@index');
    Route::get('company/selectCompany','CompanyController@selectCompany');

    Route::get('istatus','IstatusController@index');
    Route::get('istatus/selectIstatus','IstatusController@selectIstatus');
    Route::get('istatus/selectIstatus','IstatusController@selectIstatus');

    Route::get('user','UserController@index');
    Route::post('user/store','UserController@store');
    Route::put('user/update','UserController@update');
    Route::put('user/desactivate','UserController@desactivate');
    Route::put('user/activate','UserController@activate');
    Route::get('user/selectUser','UserController@selectUser');

    Route::get('inspector','InspectorController@index');
    Route::get('inspector/listInspector','InspectorController@listInspector');
    Route::get('inspector/search','InspectorController@searchInspector');
    Route::post('inspector/store','InspectorController@store');
    Route::put('inspector/update','InspectorController@update');
    Route::put('inspector/desactivate','InspectorController@desactivate');
    Route::put('inspector/activate','InspectorController@activate');
    Route::get('inspector/selectInspector','InspectorController@selectUser');

    Route::put('arrangeInspector','InspdetailController@arrangeInspector');
    Route::get('assign/getDetails','InspdetailController@getDetails');
    Route::get('assign/getDetailsAssigned','InspdetailController@getDetailsAssigned');
    Route::put('assign/dismissInspector','InspdetailController@dismissInspector');
    Route::put('assign/editPrice','InspdetailController@editPrice');

    Route::get('action/index','ActionController@indexAction');

    Route::put('action/storeCheckIn','ActionController@storeCheckIn');

    Route::get('onaction/index','OnactionController@indexOnAction');
    Route::get('onaction/getDetail','OnactionController@getDetail');
    Route::put('onaction/storeCheckOut','CciactionController@storeCheckOut');
    Route::put('onaction/storeCheckOutQci','QciactionController@storeCheckOut');
    Route::put('onaction/storeCheckOutSfa','SfaactionController@storeCheckOut');

    Route::get('monitor/index','MonitorController@indexMonitor');
    Route::get('monitor/indexMonitorUp','MonitorController@indexMonitorUp');
    Route::post('monitor/storeMonitor','MonitorController@storeMonitor');
    Route::put('monitor/storeUpdate','MonitorController@storeUpdate');


    Route::get('score/index','ScoreController@indexScore');
    Route::get('score/indexQci','ScoreController@indexScoreQci');
    Route::get('score/indexSfa','ScoreController@indexScoreSfa');
    Route::get('score/indexSfaSale','ScoreController@indexScoreSfaSale');
    Route::get('score/indexScoreUp','ScoreController@indexScoreUp');
    Route::get('score/getDefectQci','ScoreController@getDefectQci');
    Route::put('score/confirmInfo','ScoreController@confirmInfo');
    Route::put('score/addNewDefect','ScoreController@addNewDefect');
    Route::put('score/deleteDefectEdit','ScoreController@deleteDefectEdit');
    Route::put('score/editSfainfo','ScoreController@editSfainfo');
    Route::put('score/newSfaScore','ScoreController@newSfaScore');

    Route::get('report/index','ReportController@indexScore');
    Route::get('report/indexQci','ReportController@indexScoreQci');
    Route::get('report/indexSfa','ReportController@indexScoreSfa');
    Route::get('report/indexScoreUp','ReportController@indexScoreUp');
    Route::get('report/getDefectQci','ReportController@getDefectQci');
    Route::put('report/confirmInfo','ReportController@confirmInfo');
    Route::put('report/addNewDefect','ReportController@addNewDefect');
    Route::put('report/deleteDefectEdit','ReportController@deleteDefectEdit');
    Route::put('report/editSfainfo','ReportController@editSfainfo');
    Route::put('report/newSfaScore','ReportController@newSfaScore');
    Route::get('report/download/{id}','ReportController@downloadLiveReport');


    Route::get('complete/indexCompleted','ScoreController@indexCompleted');
    Route::put('complete/saleClosing','ScoreController@saleClosing');

    Route::get('invoice/indexInvoice','InvoiceController@indexInvoice');
    Route::put('invoice/printed','InvoiceController@invoicePrint');


}); /*FIN ADMIN*/

/*INICIO CUSTOMER SERVICE*/
Route::group(['middleware' => ['CustomerService']], function () {
    Route::get('customer','CustomerController@index');
    Route::post('customer/store','CustomerController@store');
    Route::put('customer/update','CustomerController@update');
    Route::get('customer/selectCustomer','CustomerController@selectCustomer');

    Route::get('supplier','SupplierController@index');
    Route::post('supplier/store','SupplierController@store');
    Route::put('supplier/update','SupplierController@update');
    Route::get('supplier/selectSupplier','SupplierController@selectSupplier');

    Route::put('service/updateAfter','ServiceController@updateAfter');
    Route::get('followup/getFollowup','FollowupController@getFollowup');
    Route::post('followup/store','FollowupController@store');
    Route::put('followup/desactivate','FollowupController@desactivate');

    Route::get('cost','CosttypeController@index');
    Route::post('cost/store','CosttypeController@store');
    Route::put('cost/update','CosttypeController@update');
    Route::put('cost/desactivate','CosttypeController@desactivate');
    Route::put('cost/activate','CosttypeController@activate');
    Route::get('cost/selectCost','ForwarderController@selectCost');

    Route::get('invoice/indexInvoice','InvoiceController@indexInvoice');
    Route::put('invoice/printed','InvoiceController@invoicePrint');
});/*FIN CS*/

/*SUPERVISOR*/
Route::group(['middleware' => ['Supervisor']], function () {

  Route::get('inspector','InspectorController@index');
  Route::get('inspector/listInspector','InspectorController@listInspector');
  Route::get('inspector/search','InspectorController@searchInspector');
  Route::post('inspector/store','InspectorController@store');
  Route::put('inspector/update','InspectorController@update');
  Route::put('inspector/desactivate','InspectorController@desactivate');
  Route::put('inspector/activate','InspectorController@activate');
  Route::get('inspector/selectInspector','InspectorController@selectUser');

  Route::put('arrangeInspector','InspdetailController@arrangeInspector');
  Route::get('assign/getDetails','InspdetailController@getDetails');
  Route::get('assign/getDetailsAssigned','InspdetailController@getDetailsAssigned');
  Route::put('assign/dismissInspector','InspdetailController@dismissInspector');
  Route::put('assign/editPrice','InspdetailController@editPrice');



  Route::get('score/index','ScoreController@indexScore');
  Route::get('score/indexQci','ScoreController@indexScoreQci');
  Route::get('score/indexSfa','ScoreController@indexScoreSfa');
  Route::get('score/indexSfaSale','ScoreController@indexScoreSfaSale');
  Route::get('score/indexScoreUp','ScoreController@indexScoreUp');
  Route::get('score/getDefectQci','ScoreController@getDefectQci');
  Route::put('score/confirmInfo','ScoreController@confirmInfo');
  Route::put('score/addNewDefect','ScoreController@addNewDefect');
  Route::put('score/deleteDefectEdit','ScoreController@deleteDefectEdit');
  Route::put('score/editSfainfo','ScoreController@editSfainfo');
  Route::put('score/newSfaScore','ScoreController@newSfaScore');

});/*SUPERVISOR*/

/*INICIO INSPECTOR*/
Route::group(['middleware' => ['Inspector']], function () {

  Route::get('action/index','ActionController@indexAction');
  Route::put('action/storeCheckIn','ActionController@storeCheckIn');

  Route::get('onaction/index','OnactionController@indexOnAction');
  Route::get('onaction/getDetail','OnactionController@getDetail');
  Route::put('onaction/storeCheckOut','CciactionController@storeCheckOut');
  Route::put('onaction/storeCheckOutQci','QciactionController@storeCheckOut');
  Route::put('onaction/storeCheckOutSfa','SfaactionController@storeCheckOut');

});/*FIN INSPECTOR*/

/*INICIO SALESCONSULTANT*/
Route::group(['middleware' => ['SalesConsultant']], function () {

    Route::get('complete/indexCompleted','ScoreController@indexCompleted');
    Route::put('complete/saleClosing','ScoreController@saleClosing');

 });/*FIN SALESCONSULTANT*/

/*INICIO Qconsultant*/
Route::group(['middleware' => ['QConsultant']], function () {

  Route::put('arrangeInspector','InspdetailController@arrangeInspector');
  Route::get('assign/getDetails','InspdetailController@getDetails');
  Route::get('assign/getDetailsAssigned','InspdetailController@getDetailsAssigned');
  Route::put('assign/dismissInspector','InspdetailController@dismissInspector');
  Route::put('assign/editPrice','InspdetailController@editPrice');

  Route::get('monitor/index','MonitorController@indexMonitor');
  Route::get('monitor/indexMonitorUp','MonitorController@indexMonitorUp');
  Route::post('monitor/storeMonitor','MonitorController@storeMonitor');
  Route::put('monitor/storeUpdate','MonitorController@storeUpdate');


});/*Qconsultant*/

/*INICIO Reporter*/
Route::group(['middleware' => ['Reporter']], function () {
  Route::get('report/index','ReportController@indexScore');
  Route::get('report/indexQci','ReportController@indexScoreQci');
  Route::get('report/indexSfa','ReportController@indexScoreSfa');
  Route::get('report/indexScoreUp','ReportController@indexScoreUp');
  Route::get('report/getDefectQci','ReportController@getDefectQci');
  Route::put('report/confirmInfo','ReportController@confirmInfo');
  Route::put('report/addNewDefect','ReportController@addNewDefect');
  Route::put('report/deleteDefectEdit','ReportController@deleteDefectEdit');
  Route::put('report/editSfainfo','ReportController@editSfainfo');
  Route::put('report/newSfaScore','ReportController@newSfaScore');
  Route::get('report/download/{id}','ReportController@downloadLiveReport');
});/*Reporter*/

/*INICIO CUSTOMER*/
Route::group(['middleware' => ['Customer']], function () {});/*FIN CUSTOMER*/

/*INICIO DATAMANAGER*/
Route::group(['middleware' => ['DataManager']], function () {});/*FIN DATAMANAGER*/

});//CIERRA




//Auth::routes();

//App\Followup::join('comments','followups.id','=','comments.idfollowup')->select('followups.content','comments.content as comments_content')->get();

Route::get('/home', 'HomeController@index')->name('home');
