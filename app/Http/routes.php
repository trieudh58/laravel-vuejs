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

Route::get('/', function () {
    return redirect('/todos');
//    return view('welcome');
});

Route::get('/todos', 'TodoController@show');
Route::get('/todos/get', 'TodoController@get');

Route::post('/todos/create', 'TodoController@create');
