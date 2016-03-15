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
	'users'=> 'UsersController'
]);
Route::get('/operacion/estadisticas','OperacionController@estadisticas');
Route::get("/cheques/{id}/venta","ChequesController@venta");
Route::post("/cheques/grabarventa",'ChequesController@grabarVenta');
Route::resource('operacion','OperacionController');
Route::resource('cheques', 'ChequesController');
Route::resource('cuits', 'CuitsController');
Route::resource('clientes','ClientesController');
Route::resource('concepto', 'ConceptoController');
Route::resource('movimientos', 'MovimientosController');
Route::resource('bancos', 'BancosController');
Route::resource('carteras', 'CarterasController');


Route::group( ['prefix'=> 'Admin','middleware'=>'auth','namespace'=>'Admin'], function() {
	Route::resource('user','UserController');
	
});

