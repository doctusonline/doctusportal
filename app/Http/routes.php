<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('dashboard', 'WelcomeController@index');
Route::get('homepage', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('generate','AjaxController@index');

Route::get('/','BookingController@index');
Route::get('home', 'BookingController@index');
Route::get('bookingtest','BookingController@test');
Route::get('iframe','BookingController@iframe');

Route::get('payment','PaymentController@index');
Route::get('payment/{reference}','PaymentController@index');

Route::get('pdf/{file}','AjaxController@pdfError');

/* AJAX Controller */
Route::group(array('prefix' => 'ajax'), function(){
	Route::post('generate/orders', 'AjaxController@orders');
	Route::post('generate/pdf', 'AjaxController@generatePDF');
	Route::get('generate/pdf', 'AjaxController@generatePDF');
});

/* API Controller */
Route::group(array('prefix' => 'api'), function(){	
	Route::post('create', 'BookingController@create');	
	Route::post('payment/create', 'PaymentController@create');	
	Route::post('checkout','CheckoutController@checkout');
});