<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home.index');
}); 

Auth::routes();
Route::get('/home', 'Home\HomeController@index')->name('home.index');
Route::get('/painel', 'Painel\PainelController@index')->name('painel.index');

Route::get('/painel/user', 'User\UserController@index')->name('user.lista');
Route::get('/painel/user/create', 'User\UserController@create')->name('user.create');
Route::post('/painel/user/store', 'User\UserController@store')->name('user.store');
Route::get('/painel/arma/calibre', 'Arma\CalibreController@calibre_lista')->name('arma.calibre.lista');
Route::get('/painel/arma/tipo', 'Arma\TipoController@tipo_lista')->name('arma.tipo.lista');
Route::get('/painel/arma/marca', 'Arma\MarcaController@marca_lista')->name('arma.marca.lista');
Route::get('/painel/arma/fabricante', 'Arma\FabricanteController@fabricante_lista')->name('arma.fabricante.lista');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
