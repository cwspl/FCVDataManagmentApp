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
    Route::post('customer', 'CustomersController@postCustomer');
    Route::get('customers','CustomersController@getCustomers');
    Route::get('customer/{customer_id}', 'CustomersController@getCustomer');
    Route::put('customer/{customer_id}', 'CustomersController@putCustomer');
    Route::delete('customer/{customer_id}', 'CustomersController@deleteCustomer');
});