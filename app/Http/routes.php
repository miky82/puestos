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
/*
Route::get('/', function () {
    return view('welcome');
})->middleware('auth'); // Solo se permite el acceso a usuarios autenticados
*/
Route::auth();
Route::get('/', 'HomeController@index');
//Route::get('/home', 'HomeController@index');

Route::get('/mesa', 'MesaController@index');
Route::get('/mesaLista', 'MesaController@lista');

Route::get('/votacion/mostrar/{id}/{idp}', 'VotacionController@mostrar');
Route::post('/guardarVotos','VotacionController@InsOrUpdVotacion');

Route::get('/local', 'LocalController@index');
Route::get('/localLista', 'LocalController@lista');

