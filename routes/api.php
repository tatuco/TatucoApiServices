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

// no se que hace
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', 'ApiController@api');
Route::post('/login', ['uses' => 'AuthController@login', 'as' => 'login']);
Route::post('/logout', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@logout', 'as' => 'logout']);
Route::get('/validate', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@validate', 'as' => 'validate']);

Route::resource('users','UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource('roles','RoleController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
Route::resource('permissions','PermissionController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);


//rutas disponibles solo si esta logueado
Route::group([
    'middleware' => ['jwt.auth']
    ], function (){

        // RUTAS DEL ACL
        Route::post('users/assigned/role', 'UserController@assignedRole');
        Route::get('users/revoke/role/{user}/{role}', 'UserController@revokeRole');
        Route::post('roles/assigned/permission', 'RoleController@assignedPermission');
        Route::get('roles/revoke/permission/{role}/{permission}', 'RoleController@revokePermission');



}); //cierre del function
