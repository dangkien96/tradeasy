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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '', 'middleware' => ['api']], function() {
    Route::post('buy-business', 'Api\SendMailCtrl@buyBusiness');
    Route::post('sell-business', 'Api\SendMailCtrl@sellBusiness');
    Route::post('event-register', 'Api\SendMailCtrl@addEvent');
    Route::post('contact', 'Api\SendMailCtrl@addContact');
});

