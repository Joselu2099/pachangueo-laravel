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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/memes', 'App\Http\Controllers\MemeController@index')->name("games.index");
Route::get('/memes/find', 'App\Http\Controllers\HomeController@find')->name("games.find");
Route::get('/memes/{id}', 'App\Http\Controllers\MemeController@show')->name("meme.show");

Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin/memes', 'App\Http\Controllers\Admin\AdminMemeController@index')->name("admin.meme.index");
Route::post('/admin/memes/store', 'App\Http\Controllers\Admin\AdminMemeController@store')->name("admin.meme.store");
Route::delete('/admin/memes/{id}/delete', 'App\Http\Controllers\Admin\AdminMemeController@delete')->name("admin.meme.delete");
Route::get('/admin/memes/{id}/edit', 'App\Http\Controllers\Admin\AdminMemeController@edit')->name("admin.meme.edit");
Route::put('/admin/memes/{id}/update', 'App\Http\Controllers\Admin\AdminMemeController@update')->name("admin.meme.update");

/*
Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/memes', 'App\Http\Controllers\Admin\AdminMemeController@index')->name("admin.meme.index");
    Route::post('/admin/memes/store', 'App\Http\Controllers\Admin\AdminMemeController@store')->name("admin.meme.store");
    Route::delete('/admin/memes/{id}/delete', 'App\Http\Controllers\Admin\AdminMemeController@delete')->name("admin.meme.delete");
    Route::get('/admin/memes/{id}/edit', 'App\Http\Controllers\Admin\AdminMemeController@edit')->name("admin.meme.edit");
    Route::put('/admin/memes/{id}/update', 'App\Http\Controllers\Admin\AdminMemeController@update')->name("admin.meme.update");
});
*/

