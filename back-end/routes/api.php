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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/customer', [
    'uses' => 'CustomersController@postCustomer'
]);
Route::get('/customers', [
    'uses' => 'CustomersController@getCustomers'
]);
Route::get('/customer/{customer_id}', [
    'uses' => 'CustomersController@getCustomer'
]);
Route::put('/customer/{customer_id}', [
    'uses' => 'CustomersController@putCustomer'
]);
Route::delete('/customer/{customer_id}', [
    'uses' => 'CustomersController@deleteCustomer'
]);