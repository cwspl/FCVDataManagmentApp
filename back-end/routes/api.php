<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/agent/signup', [
    'uses' => 'CityAgentController@signUp'
]);
Route::post('/agent/login', [
    'uses' => 'CityAgentController@signIn'
]);
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('agent/details', 'CityAgentController@getAgent');
    Route::get('agent/logout', 'CityAgentController@logoutAgent');
    
    Route::post('area','AreaController@createArea');
    Route::get('areas','AreaController@getAreas');
    Route::get('area/{area_id}','AreaController@getArea');
    Route::put('area/{area_id}','AreaController@putArea');
    Route::delete('area/{area_id}','AreaController@deleteArea');

    Route::post('customer', 'CustomersController@postCustomer');
    Route::get('customers','CustomersController@getCustomers');
    Route::get('customers/{area_id}','CustomersController@getAreaCustomers');
    Route::get('customers/{area_ids}/{years}','CustomersTableController@getCustomers');
    Route::get('customer/{customer_id}', 'CustomersController@getCustomer');
    Route::put('customer/{customer_id}', 'CustomersController@putCustomer');
    Route::put('customer/{customer_id}/payment', 'CustomerPaymentsController@changePayment');
    Route::put('customer/{customer_id}/charge', 'CustomerPaymentsController@changeCharge');
    Route::delete('customer/{customer_id}', 'CustomersController@deleteCustomer');
    
    Route::post('accountNumber/{customer_id}','AccountNumbersController@createAccountNumber');
    Route::put('accountNumber/{account_number_id}','AccountNumbersController@editAccountNumber');
    Route::delete('accountNumber/{account_number_id}','AccountNumbersController@deleteAccountNumber');

});