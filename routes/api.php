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

//Route::group(['prefix' => 'api','middleware'=> ['cors']], function() {
//    Route::get('/music_styles/', 'MusicStyleController@index');
//    Route::get('/musicians', 'MusiciansController@index');
//
//    Route::post('/suggestions', 'SuggestionsController@store');
//    Route::get('/hirer', 'HirerController@index');
//    Route::get('/users', 'UsuarioController@index');
//    Route::post('/users', 'UsuarioController@login');
//
//    Route::get('/show', 'ShowAgendaController@index');
//    Route::get('/show/{id}', 'ClienteController@show');
//    Route::put('/show/{id}', 'ShowAgendaController@update');
//    Route::post('/show', 'ShowAgendaController@store');
//    Route::delete('/show/{id}', 'ShowAgendaController@destroy');
//});

Route::get('/music_styles', 'MusicStyleController@index');
Route::get('/musicians', 'MusiciansController@index');

Route::post('/suggestions', 'SuggestionsController@store');
Route::get('/hirer', 'HirerController@index');
Route::get('/users', 'UsuarioController@index');
Route::post('/users', 'UsuarioController@login');

Route::get('/show', 'ShowAgendaController@index');
Route::get('/show/{id}', 'ClienteController@show');
Route::put('/show/{id}', 'ShowAgendaController@update');
Route::post('/show', 'ShowAgendaController@store');
Route::delete('/show/{id}', 'ShowAgendaController@destroy');
