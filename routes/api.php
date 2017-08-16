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

Route::group(['namespace' => 'backend', 'prefix' => 'v1'], function() {

	Route::group(['prefix' => 'users'], function() {

		Route::post('checkuser','UsersControllers@checkUser');
		Route::post('login','UsersControllers@signIn');

	});

});

Route::group(['middleware' => ['validate_token']], function () {

	Route::group(['namespace' => 'backend', 'prefix' => 'v1'], function() {

		Route::group(['prefix' => 'mail'], function() {

			Route::post('send','EmailController@sendMail');
			Route::post('check','EmailController@getAllMails');
			Route::post('change','EmailController@updateMail');

		});

		Route::group(['prefix' => 'contact'], function() {

			Route::post('fetch','ContactController@getMyBuddies');

		});
	});
});