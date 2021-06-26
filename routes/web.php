<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
return view('welcome');
});*/

Route::get('/', 'SeriesController@index');
Route::get('/series', 'SeriesController@index')
    ->name('series.index');
Route::get('/series/adicionar', 'SeriesController@create')
    ->name('series.create')
    ->middleware('autenticador');
Route::post('/series/adicionar', 'SeriesController@store')->middleware('autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')->middleware('autenticador');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::post('/series/{id}/editarNome', 'SeriesController@editarNome')->middleware('autenticador');
Route::get('/series/{serie}/{temporada}', 'EpisodiosController@index');
Route::post('/series/{serie}/{temporada}', 'EpisodiosController@assistir')->middleware('autenticador');

//Referente as autenticações do Laravel
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Personalizando entrar e registrar.
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/sair', 'EntrarController@sair');
Route::get('/registro', 'RegistroController@index');
Route::post('/registro', 'RegistroController@registro');
