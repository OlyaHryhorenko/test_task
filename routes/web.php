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

Route::get('/', 'MatchController@index');
Route::post('/add-team', ['uses'=>'TeamController@store', 'as' => 'team.new']);

Route::get('/team/{id}', ['uses'=>'TeamController@show', 'as' => 'team.show']);
Route::post('/add-match', ['uses'=>'MatchController@store', 'as' => 'match.new']);
Route::post('/add-match-results', ['uses'=>'MatchController@update', 'as' => 'match.update']);
