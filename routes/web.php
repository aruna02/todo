<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/todo/{id}','TodoController@index')->name('todos');
Route::get('/todo/add/{data}','TodoController@add')->name('savetodo');
Route::post('/todo/updateDate','TodoController@updateTodo')->name('updatedate');
Route::post('/todo/updateStatus','TodoController@updateStatus')->name('updatestatus');
Route::post('/todo/delete','TodoController@delete')->name('delete');
Route::get('/todo/search/{name}','TodoController@searchByName')->name('search');