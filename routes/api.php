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
Route::get('/report/prueba','Inventary\BrandController@report');
Route::get('/', 'Tatuco\ApiController@api');
Route::get('/home', 'Tatuco\ApiController@api');
Route::post('/login', ['uses' => 'Tatuco\AuthController@login', 'as' => 'login']);
Route::post('/logout', ['middleware' => ['jwt.auth'], 'uses' => 'Tatuco\AuthController@logout', 'as' => 'logout']);
Route::get('/validate', ['middleware' => ['jwt.auth'], 'uses' => 'Tatuco\AuthController@validate', 'as' => 'validate']);
Route::get('/admin', function()
{
    echo "eres sysadmin!";
})->middleware('role:sysadmin');

Route::get('/permiso', function()
{
    echo "tienes permiso!";
})->middleware('permission:run.backup');

/**
 * grupo de rutas controladas por jwt (requieren token)
 */
Route::group([
    'middleware' => ['jwt.auth']
    ], function (){
    /**
     * grupo de rutas controladas por el rol sysadmin
     */
    Route::group(['middleware' => ['role:sysadmin']], function (){
        //rutas a la carpeta tatuco
        Route::resource('users', 'Tatuco\UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        Route::resource('roles', 'Tatuco\RoleController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        Route::resource('permissions', 'Tatuco\PermissionController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
        Route::get('/backup', 'Tatuco\TatucoController@backup')->middleware('permission:run.backup');
        Route::post('users/role', 'Tatuco\UserController@assignedRole');
        Route::get('users/role/{user}/{role}', 'Tatuco\UserController@revokeRole');
        Route::post('roles/permission', 'Tatuco\RoleController@assignedPermission');
        Route::get('roles/permission/{role}/{permission}', 'Tatuco\RoleController@revokePermission');


        //rutas a la carpeta gasolinera
        Route::resource('accounts', 'Gasolinera\AccountController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);


        /**
         * rutas con el prefijo types
         */
        Route::group(['prefix' => 'types'], function () {
            Route::resource('/clients', 'Inventary\ClientTypeController', ['only' => ['index', 'store', 'update', 'destroy', 'show','create']]);
        });//cierre de rutas types


        /**
         * rutas con el prefijo reports
         */
        Route::group(['prefix' => 'reports'], function () {
            Route::get('users','Tatuco\ReportController@users');
            Route::get('accounts','Tatuco\ReportController@accounts');
        });//cierre de rutas de reporte

    });
});//cierre de rutas que necesitan token (loguearse)
