<?php

namespace App\Http\Controllers\Tatuco;

use App\Models\Tatuco\User;
use Illuminate\Http\Request;

use App\Reports\src\ReportMedia\ExcelReport;
use App\Reports\src\ReportMedia\PdfReport;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Tatuco\ReportService;


class ReportController extends Controller
{
    // PdfReport Aliases
    // use PdfReport;

    /**
     * @param Request $request
     * @return mixed
     */
    public $service;
    public $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    //reportes de usuarios
    public function users(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'DNI' => 'use_dni',
            'Nombres y Apellidos' => 'use_nam',
            'Email' => 'email',
            'Nombre de Usuario' => 'use_nic'
        ];
        //setea el nombre del modelo
        $model='App\Models\Tatuco\User';
        //setea el nombre plural
        $namePlural='Usuarios';
        $title='Reporte de Usuarios';
        $row = 'use_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de usuarios
    public function accounts(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre' => 'acc_nom',
            'RUC' => 'acc_ruc',
            'Descripcion' => 'acc_des',
            'Direccion' => 'acc_dir',
            'Correo' => 'acc_mai',
            'Telefono' => 'acc_pho',
            'Web' => 'acc_web'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\Account';
        //setea el nombre plural
        $namePlural='Empresas';
        $title='Reporte de Empresas';
        $row = 'acc_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de conductores
    public function status(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre' => 'sta_des',
            'Entidad donde se usa' => 'sta_tab'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\Status';
        //setea el nombre plural
        $namePlural='Status';
        $title='Reporte de Status';
        $row = 'sta_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de conductores
    public function drivers(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'DNI' => 'dri_dni',
            'Nombres' => 'dri_nam', 'dri_lna',
            'Licencia' => 'dri_lic',
            'Telefono' => 'dri_pho',
            'Email' => 'dri_mai'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\Driver';
        //setea el nombre plural
        $namePlural='Conductores';
        $title='Reporte de Conductores';
        $row = 'dri_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de marcas de vehiculos
    public function brandsVehicles(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre de la Marca' => 'bra_des'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\BrandVehicle';
        //setea el nombre plural
        $namePlural='Marcas de Vehiculos';
        $title='Reporte de Marcas de Vehiculos';
        $row = 'bra_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de modelos vehiculos
    public function modelsVehicles(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre del Modelo' => 'mod_des'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\ModelVehicle';
        //setea el nombre plural
        $namePlural='Modelos de Vehiculos';
        $title='Reporte de Modelos de Vehiculos';
        $row = 'mod_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }

    //reportes de tipos vehiculos
    public function typesVehicles(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre del Tipo de Vehiculo' => 'tve_des'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\TypeVehicle';
        //setea el nombre plural
        $namePlural='Tipos de Vehiculos';
        $title='Reporte de Tipos de Vehiculos';
        $row = 'tve_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }


    //reportes de  vehiculos
    public function fleets(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Nombre de la Flota' => 'fle_des'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\Fleet';
        //setea el nombre plural
        $namePlural='Flotas';
        $title='Reporte de Flotas';
        $row = 'fle_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }


    //reportes de  vehiculos
    public function vehicles(Request $request)
    {
        //Parametros a pasar al service

        //setea las nombres con las columnas en la bd
        $columns = [
            'Placa' => 'veh_pla',
            'Nombre del Vehiculo' => 'veh_des',
            'Limite de Consumo' => 'veh_com',
            'Tipo de Vehiculo' => 'tve_id',
            'Modelo del Vehiculo' => 'mod_id',
            'Flota del Vehiculo' => 'fle_id',
            'Estado de Asignacion' => 'sta_id'
        ];
        //setea el nombre del modelo
        $model='App\Models\Gasolinera\Vehicle';
        //setea el nombre plural
        $namePlural='Vehiculos';
        $title='Reporte de Vehiculos';
        $row = 'veh_act';
        //$query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')->get();

        //envio los datos a la super funcion report()
        return $this->reportService->report($request,$model, $namePlural, $columns, $title, $row);
    }
}