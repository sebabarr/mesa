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
Route::get('/cheques/imprimirCesiones','ChequesController@imprimirCesiones');
Route::get('/cheques/FiltrarCheques','ChequesController@FiltrarCheques');
Route::get('/cheques/buscasaldocuit','ChequesController@bussalcuit');
Route::get('/cheques/buscasaldo','ChequesController@bussalcli');
Route::get('/cheques/totxclientes','ChequesController@totxcli');
Route::get('/cheques/totxcuits','ChequesController@totxcuits');
Route::get('/cheques/tot_ing_eng','ChequesController@tot_ing_eng');
Route::get('/cheques/{id}/imprimircesion',"ChequesController@imprimircesion");
Route::get('/bancos/imprimir','BancosController@imprimir');
Route::get('/operacion/estadisticas','OperacionController@estadisticas');
Route::get('/operacion/totxmon','OperacionController@totalesxmoneda');
Route::get('/operacion/caltotmoneda','OperacionController@caltotmoneda');
Route::get("/cheques/{id}/venta","ChequesController@venta");
Route::post("/cheques/grabarventa",'ChequesController@grabarVenta');
Route::get('/cheques/t_ing_eng','ChequesController@t_ing_eng');
Route::get('/cheques/buscarcheque','ChequesController@buscarcheque');
Route::resource('operacion','OperacionController');
Route::resource('cheques', 'ChequesController');
Route::resource('cuits', 'CuitsController');
Route::resource('clientes','ClientesController');
Route::resource('concepto', 'ConceptoController');
Route::resource('movicheques','MovichequeController');
Route::resource('movimientos', 'MovimientosController');
Route::resource('bancos', 'BancosController');
Route::resource('carteras', 'CarterasController');


Route::group( ['prefix'=> 'Admin','middleware'=>'auth','namespace'=>'Admin'], function() {
	Route::resource('user','UserController');
	
});

