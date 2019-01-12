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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes For Api 

Route::group(['namespace' => 'Api','prefix'=>'orders'],function(){

		Route::get('list/{orderId?}','OrderController@listOrder');
		Route::post('create','OrderController@createOrder');
		

});


Route::group(['namespace' => 'Api','prefix'=>'invoices'],function(){

		Route::get('list/{invoiceId?}','InvoiceController@listInvoice');
		Route::post('create','InvoiceController@createInvoice');		
});
