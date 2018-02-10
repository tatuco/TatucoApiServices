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
Route::resource('users', 'Tatuco\UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show','create']]);
Route::get('/prueba', 'Tatuco\UserController@prueba');
Route::get('/model', 'Tatuco\UserController@pruebaModel');
Route::get('/home', 'Tatuco\ApiController@api');
Route::post('/login', ['uses' => 'Tatuco\AuthController@login', 'as' => 'login']);
Route::post('/logout', ['middleware' => ['jwt.auth'], 'uses' => 'Tatuco\AuthController@logout', 'as' => 'logout']);
Route::get('/validate', ['middleware' => ['jwt.auth'], 'uses' => 'Tatuco\AuthController@validate', 'as' => 'validate']);
Route::get('/admin', function()
{
    echo "Is admin!";
})->middleware('role:SYSADMIN');

Route::get('/permiso', function()
{
    echo "Is admin!";
})->middleware('permission:SYSADMIN');

/**
 * grupo de rutas controladas por jwt (requieren token)
 */
Route::group([
    'middleware' => ['jwt.auth']
    ], function (){

    /**
     * grupo de rutas controladas por el rol sysadmin
     */
        Route::group([
            'middleware' => ['role:SYSADMIN']
        ], function (){
            Route::post('users/assigned/role', 'Tatuco\UserController@assignedRole');
            Route::get('users/revoke/role/{user}/{role}', 'Tatuco\UserController@revokeRole');
            Route::post('roles/assigned/permission', 'Tatuco\RoleController@assignedPermission');
            Route::get('roles/revoke/permission/{role}/{permission}', 'Tatuco\RoleController@revokePermission');
        });
    /**
     * grupo de rutas controladas por los roles sysadmin y admin
     */
        Route::group([
            'middleware' => ['role:SYSADMIN','role:ADMIN']
        ], function () {

            
            Route::resource('roles', 'Tatuco\RoleController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
            Route::resource('permissions', 'Tatuco\PermissionController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        });


});
