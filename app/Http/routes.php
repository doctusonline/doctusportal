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

Route::get('orders', 'WelcomeController@index');
Route::get('dashboard', 'HomeController@index');
Route::get('homepage', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('generate','AjaxController@index');
Route::get('dompdf','AjaxController@generateDomPdf');

Route::get('/','BookingController@index');
Route::get('home', 'BookingController@index');
Route::get('bookingtest','BookingController@test');
Route::get('iframe','BookingController@iframe');

Route::get('payment','PaymentController@index');
Route::get('payment/{reference}','PaymentController@index');

Route::get('pdf/{file}','AjaxController@pdfError');

Route::resource('users','UserController');

/* AJAX Controller */
Route::group(array('prefix' => 'ajax'), function(){
	Route::post('generate/orders', 'AjaxController@orders');
	Route::post('generate/pdf', 'AjaxController@generatePDF');
	Route::get('generate/pdf', 'AjaxController@generatePDF');
	Route::post('update/order', 'AjaxController@updateOrder');	
	Route::get('users', 'AjaxController@getUsers');
	Route::get('users/{user_id}', 'AjaxController@getUser');
	Route::post('users/update','UserController@update');
	Route::get('users/create-image/{userId}','AjaxController@createUserImage');
});

/* API Controller */
Route::group(array('prefix' => 'api'), function(){	
	Route::post('create', 'BookingController@create');	
	Route::post('payment/create', 'PaymentController@create');	
	Route::post('checkout','CheckoutController@checkout');
});