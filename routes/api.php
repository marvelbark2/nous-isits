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

Route::post('/matiere/{id}', 'matierecontroller@ma');
Route::get('/notes', 'noteController@all');
Route::post('/notes', 'noteController@ap');
Route::get('/enote', 'noteController@enote');
Route::get('/idann', 'noteController@idann');

Route::post('/format/{id}', 'DelibController@forma');
Route::post('/promo/{id}', 'DelibController@promos');
Route::post('/semestre/{id}', 'DelibController@semestre');

Route::post('/register', 'UserController@register')->middleware('guest');

Route::post('/login', 'UserController@login')->middleware('guest');

Route::post('/update/token', 'UserController@updateToken');
