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
Route::get('/admin', function()
{
    echo "Is admin!";
})->middleware('roleshinobi:SYSADMIN');
//Rutas disponibles sin loguearse
Route::get('/home', 'ApiController@api');
Route::post('/login', ['uses' => 'AuthController@login', 'as' => 'login']);
Route::post('/logout', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@logout', 'as' => 'logout']);
Route::get('/validate', ['middleware' => ['jwt.auth'], 'uses' => 'AuthController@validate', 'as' => 'validate']);

//rutas disponibles solo si esta logueado
Route::group([
    'middleware' => ['jwt.auth']
    ], function (){
    /* Route::group(['as' => 'sysadmin.',
        'middleware'=> ['roleshinobi:SYSADMIN']
    ], function(){*/

        /*
         * Seccion de Users
         */

        Route::resource('users','UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show','create']]);
        Route::post('users/assigned/role', 'UserController@assignedRole');
        Route::get('users/revoke/role/{user}/{role}', 'UserController@revokeRole');

        //Fin de la seccion Users

        /*
         * Secccion Roles
         */

        Route::resource('roles','RoleController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        Route::post('roles/assigned/permission', 'RoleController@assignedPermission');
        Route::get('roles/revoke/permission/{role}/{permission}', 'RoleController@revokePermission');

        //fin de la seccion Roles

        /*
        *  Seccion Permissions
        */

        Route::resource('permissions','PermissionController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);

        //fin de la seccion Permissions
   // });

}); //cierre del function
