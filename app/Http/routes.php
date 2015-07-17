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

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('generate','AjaxController@index');
Route::get('booking','BookingController@index');
Route::get('bookingtest','BookingController@test');
Route::get('booking/iframe','BookingController@iframe');

Route::get('booking/payment','PaymentController@index');
Route::get('booking/payment/{reference}','PaymentController@index');

/* Ajax Controller */
Route::group(array('prefix' => 'api'), function(){
	Route::post('generate/orders', 'AjaxController@orders');	
	Route::post('booking/create', 'BookingController@create');	
	Route::post('payment/create', 'PaymentController@create');	
	Route::post('checkout','CheckoutController@checkout');
});