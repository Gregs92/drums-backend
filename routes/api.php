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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/beats/{id}', 'BeatsController@getBeat');

Route::get('/beats', 'BeatsController@getBeats');

Route::post('/beats', 'BeatsController@storeBeat');

Route::post('/beats/{id}', 'BeatsController@updateBeat');

Route::get('/scores/{beat_id}', 'BeatsController@getScores');

Route::get('/scores/{beat_id}/{user_id}', 'BeatsController@getScore');

//Route::post('/scores/{beat_id}/{user_id}', 'BeatsController@storeScore');

Route::post('/scores', 'BeatsController@storeScore');