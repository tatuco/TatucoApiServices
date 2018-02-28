<?php

namespace App\Http\Services\Tatuco;

use App\Models\Gasolinera\Account;
use App\Http\Services\Tatuco\TatucoService;
use Illuminate\Http\Request;
use App\Reports\src\ReportMedia\ExcelReport;
use App\Reports\src\ReportMedia\PdfReport;
use Optimus\Bruno\LaravelController;
use Optimus\Bruno\EloquentBuilderTrait;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Reports\src\ReportMedia\CSVReport;

class ReportService extends LaravelController
{
    use EloquentBuilderTrait;
    // PdfReport Aliases
    // use PdfReport;

    /**
     *ESTE ES EL QUE ESTA EN USO
     *
     */
    // metodo para generar reporte pa todo el mundo solo crear la ruta y enviar a ModeloController@report
    public function report(Request $request, $model, $namePlural, $columns, $_title = null, $row)
    {
        //consulto los permisos
        if (!JWTAuth::parseToken()->authenticate()->can('index.report')) {
            return response()->json([
                'status'=> false,
                'message' => 'no tienes permiso index.report'
            ],403);
        }
        //saco del request los datos que necesito
        $fromDate = $request->get('from_date');//fecha de inicio
        $toDate = $request->get('to_date');//fecha fin
        $sortBy = $request->get('sort');//orden
        $format = $request->get('format');//formato
        $user = JWTAuth::parseToken()->authenticate();//saber si esta logueado
        //selecciono los datos de la cuenta para pasar al reporte
        $cuenta = Account::select('*')
        ->where('acc_id',$user->acc_id)
        ->first();
        $icon = '/var/www/html/laravel/gasolinera-api/storage/app/public/zipi.png';//imagen de la empresa
        $acc_nam = $cuenta->acc_nom;//nombre de la empresa
        $acc_ruc = $cuenta->acc_ruc;//ruc de la empresa
        $foot = $user->use_nic;//datos que saldran en el reporte al final
        $date = Carbon::now()->format('d-m-Y');//fecha actual
        $title = $_title?:"Reporte de ".$namePlural;//por si no viene titulo
        $queryBuilder = 0;
        $reqDate = $this->reqDate($fromDate, $toDate, $sortBy);//recibo la respuesta de la funcion
        $_columns = array();
        $now = Carbon::now()->format('Y-m-d');
        //si no vienen las columnas devuevlo el error
        if(!$columns){
            return response()->json([
                'column' => $columns,
                'status' => false,
                'message' => 'Columnas del Reporte No especificadas en el Controller',
                'sintaxis' => '$this->clumns = ["Title" => "campo"]'
            ], 500);
        }
        //recorro las columnas en el foreach
        foreach($columns as $column){
            array_push($_columns, $column);
        }

        //depende de la respuesta obtenida en el reqDate, hago la consulta
        switch ($reqDate?:1) {
            case 1://si en el param va fecha inicio, fecha fin y orden
                $meta = [
                    'Desde ' => $fromDate,
                    'Hasta ' => $toDate,
                    'Ordenado Por ' => $sortBy
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->whereBetween('created_at', [$fromDate, $toDate])//por rango de fechas
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id)//account logueado
                    ->orderBy($sortBy)//orden de la consulta
                    ->get();
                break;
            case 2://si en el param va fecha inicio y fin
                $meta = [
                    'Desde ' => $fromDate,
                    'Hasta ' => $toDate
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->whereBetween('created_at', [$fromDate, $toDate])//por rango de fechas
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id)//account logueado
                    ->get();
                break;
            case 3://si en el param va fecha inicio y orden
                $meta = [
                    'Del ' => $fromDate,
                    'Ordenado Por ' => $sortBy
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->whereDate('created_at', $fromDate)//por fecha especifica
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id)//account logueado
                    ->orderBy($sortBy);//orden del reporte

                break;
            case 4://si en el param va solo fecha fin no se pasa nada al query
                $meta = [
                    'Del ' => $now
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id);//account logueado
                break;
            case 5://si en el param va fecha inicio mas nada
                $meta = [
                    'Del ' => $fromDate
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->whereDate('created_at', $fromDate)//por fecha especifica
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id);//account logueado
                break;
            case 6://si ninguno va
                $meta = [];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id)//account logueado
                    ;
                break;
            case 7://si va solo sort
                $meta = [
                    'Ordenado Por ' => $sortBy
                ];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id)//account logueado
                    ->orderBy($sortBy);//orden del reporte;
                break;
            case 8://va solo fecha fin
                $meta = [];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->where($row, true)//where si esta activo o eliminado
                    ->where('acc_id', $user->acc_id);//account logueado
                break;
            default://por defecto
                $meta = [];
                //armo el query
                $queryBuilder = $model::select($_columns)
                    ->where($row,true)//where si esta activo o eliminado
                    ->where('acc_id',$user->acc_id);//account logueado

                break;
        }

        switch ($format) {
            case 'xls':
                return (new ExcelReport())->of($title, $meta, $queryBuilder, $columns, $icon, $acc_nam, $acc_ruc, $foot)
                    ->limit(20)
                    ->download('/');
                break;
            case 'pdf':
                return (new PdfReport())->of($title, $meta, $queryBuilder, $columns, $icon, $acc_nam, $acc_ruc, $foot)
                    ->setCss(['.head-content' => 'border-width: 0px'])
                    ->stream();
                break;
            case 'csv':
                return (new CSVReport())->of($title, $meta, $queryBuilder, $columns, $icon, $acc_nam, $acc_ruc, $foot)
                    ->download('/');
                break;
            default:
                //si no se indica formato devuelve json
                $resourceOptions = $this->parseResourceOptions();
                $this->applyResourceOptions($queryBuilder, $resourceOptions);
                $items = $queryBuilder->get();
                $parsedData = $this->parseData($items, $resourceOptions);
                return response()->json($parsedData, 200);
                break;
        }

    }


    /**
     * funcion que devuelve los valores que necesita el report si viene from_date, to_date, sort
     */

    public function reqDate ($fromDate, $toDate, $sortBy){
        $bandera = 0;

        //existe fecha de inicio, de fin y orden
        if(isset($fromDate) && isset($toDate) && isset($sortBy)){
            $bandera = 1;
        }
        //si existe fecha de inicio, fecha fin y no existe orden
        if (isset($fromDate) && isset($toDate) && !isset($sortBy)){
            $bandera = 2;
        }
        //si existe fecha de inicio orden pero no fecha fin
        if (isset($fromDate) && !isset($toDate) && isset($sortBy)){
            $bandera = 3;
        }
        //si no existe fecha de inicio pero si orden
        if (!isset($fromDate) && isset($toDate) && isset($sortBy)){
            $bandera = 4;
        }
        if (isset($fromDate) && !isset($toDate) && !isset($sortBy)){
            $bandera = 5;
        }
        //si no existe ninguno
        if (!isset($fromDate) && !isset($toDate) && !isset($sortBy)){
            $bandera = 6;
        }
        //si solo viene sort
        if (!isset($fromDate) && !isset($toDate) && isset($sortBy)){
            $bandera = 7;
        }
        //si solo viene sort
        if (!isset($fromDate) && isset($toDate) && !isset($sortBy)){
            $bandera = 8;
        }
        return $bandera;
    }

}