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

//HOME ROUTES
Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/login', 'App\Http\Controllers\HomeController@login')->name("home.login");
Route::get('/register', 'App\Http\Controllers\HomeController@register')->name("home.register");

//GAMES ROUTES
Route::get('/games', 'App\Http\Controllers\GameController@index')->name("games.index");
Route::get('/games/find', 'App\Http\Controllers\GameController@find')->name("games.find");
Route::get('/games/{id}', 'App\Http\Controllers\GameController@show')->name("games.show");
Route::get('/games/crud/create', 'App\Http\Controllers\GameController@create')->name("games.crud.create");
Route::post('/games/crud/store', 'App\Http\Controllers\GameController@store')->name("games.crud.store");
Route::get('/games/crud/{id}/edit', 'App\Http\Controllers\GameController@edit')->name("games.crud.edit");
Route::delete('/games/crud/{id}/delete', 'App\Http\Controllers\GameController@delete')->name("games.crud.delete");

//TEAMS ROUTES
Route::get('/teams/{id}', 'App\Http\Controllers\TeamController@show')->name("teams.show");

/*
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin/games', 'App\Http\Controllers\Admin\AdminGameController@index')->name("admin.games.index");
Route::post('/admin/games/store', 'App\Http\Controllers\Admin\AdminGameController@store')->name("admin.games.store");
Route::delete('/admin/games/{id}/delete', 'App\Http\Controllers\Admin\AdminGameController@delete')->name("admin.games.delete");
Route::get('/admin/games/{id}/edit', 'App\Http\Controllers\Admin\AdminGameController@edit')->name("admin.games.edit");
Route::put('/admin/games/{id}/update', 'App\Http\Controllers\Admin\AdminGameController@update')->name("admin.games.update");

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/games', 'App\Http\Controllers\Admin\AdminGameController@index')->name("admin.game.index");
    Route::post('/admin/games/store', 'App\Http\Controllers\Admin\AdminGameController@store')->name("admin.game.store");
    Route::delete('/admin/games/{id}/delete', 'App\Http\Controllers\Admin\AdminGameController@delete')->name("admin.game.delete");
    Route::get('/admin/games/{id}/edit', 'App\Http\Controllers\Admin\AdminGameController@edit')->name("admin.game.edit");
    Route::put('/admin/games/{id}/update', 'App\Http\Controllers\Admin\AdminGameController@update')->name("admin.game.update");
});
*/

