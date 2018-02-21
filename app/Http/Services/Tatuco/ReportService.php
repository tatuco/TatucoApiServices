<?php

namespace App\Http\Services\Tatuco;

use App\Models\Tatuco\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\Controller;
use App\Reports\src\ReportMedia\ExcelReport;
use App\Reports\src\ReportMedia\PdfReport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Reports\src\ReportMedia\CSVReport;

class ReportService
{
    
    // PdfReport Aliases
    // use PdfReport;

    /**
     * @param Request $request
     * @return mixed
     */

    public function prep(Request $request, $_title, $_columns, $query){
        $desde = $request->get('from_date');
        $toDate = $request->get('to_date');
        $sortBy = $request->get('sort');
        $format = $request->get('format');

        $title = $_title?:"Reporte";

        $meta = [
            'Desde: ' => $desde,
            'Hasta: ' => $toDate,
            'Por: ' => $sortBy
        ];

        $queryBuilder = $query;

        $columns = $_columns;

        switch ($format?:'pdf') {
            case 'xls':
                 return (new ExcelReport())->of($title, $meta, $queryBuilder, $columns)
                ->limit(20)
                ->download('/');
                break;
            case 'pdf':
                return (new PdfReport())->of($title, $meta, $queryBuilder, $columns)
                ->stream();
                break;
            default:
                return (new PdfReport())->of($title, $meta, $queryBuilder, $columns)
                ->stream();
                break;
        }

    }
    // metodo para generar reporte pa todo el mundo solo crear la ruta y enviar a ModeloController@report
    public function report(Request $request, $model, $namePlural, $columns, $_title = null)
    {

        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $sortBy = $request->get('sort');
        $format = $request->get('format');
        $icon = '../storage/app/public/tatuco.png';
        $user = JWTAuth::parseToken()->authenticate();
        $foot = 'Usuario : '.$user->name.'  Email: '.$user->email;
        $date = Carbon::now()->format('d-m-Y');
        $title = $_title?:"Reporte de ".$namePlural;

        if(isset($fromDate) && isset($toDate) && isset($sortBy)){
            $meta = [
                'Desde ' => $fromDate,
                'Hasta ' => $toDate,
                'Por ' => $sortBy
            ];
        }else{
            $meta = [];
        }
        $_columns = array();

        if(!$columns){
            return response()->json([
                'column' => $columns,
                'status' => false,
                'message' => 'Columnas del Reporte No especificadas en el Controller',
                'sintaxis' => '$this->clumns = ["Title" => "campo"]'
            ], 500);
        }
        foreach($columns as $column){
            array_push($_columns, $column);
        }

        if(count($meta)>0){
            $queryBuilder = $model->select($_columns)
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy($sortBy)
                ->get();
        }else{
            $queryBuilder = $model::select($_columns);
        }

        switch ($format?:'pdf') {
            case 'xls':
                return (new ExcelReport())->of($title, $meta, $queryBuilder, $columns)
                    ->limit(20)
                    ->download('/');
                break;
            case 'pdf':
                return (new PdfReport())->of($title, $meta, $queryBuilder, $columns, $icon, $foot, $date)
                    ->setCss(['.head-content' => 'border-width: 0px'])
                    ->stream();
                break;
            case 'csv':
                return (new CSVReport())->of($title, $meta, $queryBuilder, $columns)
                    ->download('/');
                break;
            default:
                return (new PdfReport())->of($title, $meta, $queryBuilder, $columns, $icon, $foot, $name)
                    ->setCss(['.head-content' => 'border-width: 0px'])
                    ->stream();
                break;
        }

    }

      public function prepPrueba(Request $request, $_title, $_columns, $query, $model){
        $desde = $request->get('from_date');
        $toDate = $request->get('to_date');
        $sortBy = $request->get('sort');
        $format = $request->get('format');

        $title = $_title?:"Reporte";

        $queryBuilder = $query;

        $columns = $_columns;

        $table = $model;

       return response()->json([
        'formato' => $format,
           'titulo' => $title,
            'columnas' => $columns,
            'consulta' => $queryBuilder
       ]);

    }
    public function displayReport(Request $request) {
        // Retrieve any filters
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort');
        $format = $request->input('formatType');
        // Report title
        $title = 'Reporte Usuarios Registrados';

        // For displaying filters description on header
        $meta = [
            'Desde' => $fromDate . ' Hasta ' . $toDate,
            'Por' => $sortBy
        ];

        // Do some querying..
        $queryBuilder = (new User)->select(['name', 'email', 'created_at'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy($sortBy)
            ->get();
       //$queryBuilder = DB::table('users')->select('name','email','created_at')->get();

        // Set Column to be displayed
        $columns = [
            'Name' => 'name',
            'Email' => 'email',
            'Registered At' => 'created_at', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result

            // 'Status' => function($result) { // You can do if statement or any action do you want inside this closure
            //      return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            // }
        ];

        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).

            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */
        if($format == 'xls'){
            return (new ExcelReport())->of($title, $meta, $queryBuilder, $columns)
                ->limit(20)
                ->download('/');
        }else{

            return (new PdfReport())->of($title, $meta, $queryBuilder, $columns)
                ->stream();

        }     /*  ->editColumn('Registered At', [
                'displayAs' => function($result) {
                    return $result->registered_at;
                }
            ])
            ->editColumn('Total Balance', [
                'displayAs' => function($result) {
                    return thousandSeparator($result->balance);
                }
            ])
            ->editColumns(['Total Balance', 'Status'], [
                'class' => 'right bold'
            ])
            ->showTotal([
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])*/
        //->setOrientation('landscape')

        //->setPaper('a6')
        //->stream(); // or download('filename here..') to download pdf

    }

}