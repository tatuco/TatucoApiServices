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
Route::get('/home', 'ApiController@api');
Route::post('/login', ['uses' => 'AuthController@login', 'as' => 'login']);
Route::post('/logout', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@logout', 'as' => 'logout']);
Route::get('/validate', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@validate', 'as' => 'validate']);


Route::group([
    'middleware' => ['jwt.auth']
    ], function (){
    Route::resource('users','UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
    Route::group(['as' => 'sysadmin.',
        'middleware'=> ['sysadmin']
    ], function(){
        Route::resource('roles','RoleController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        Route::resource('permissions','PermissionController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

    });

});
