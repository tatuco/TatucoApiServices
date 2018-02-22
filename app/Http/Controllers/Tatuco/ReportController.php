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
            'Nombre de Usuario' => 'use_nic',
            'Fecha Ingreso' => 'created_at',
            'Fecha Actualizado' => 'updated_at',
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
}