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

    public function reqDate($request)
    {
        $var = 0;

        //assigno la fecha de inicio, fin y el orden del request
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $sortBy = $request->get('sort');

        if(isset($fromDate) && isset($toDate) && isset($sortBy)){
            //igualo 1 cuando todos los datos existen
           $var=1;
        }
        if (isset($fromDate) && isset($toDate) && !isset($sortBy)){
            //igualo 2 cuando solo viene fecha de inicio y fin
             $var=2;
        }
        if (isset($fromDate) && !isset($toDate) && isset($sortBy)){
            //igualo 3 cuando solo viene fecha de inicio y fin
            $var=3;
        }
        if (!isset($fromDate) && isset($toDate) && isset($sortBy)){
            //igualo 4 cuando solo viene fecha de inicio y fin
            $var=4;
        }
        if (!isset($fromDate) && !isset($toDate) || !isset($sortBy)){
            //igualo 2 cuando solo viene fecha de inicio y fin
            $var=5;
        }
        return $var;
    }

    //reportes de usuarios
    public function users(Request $request)
    {
        //setea las nombres con las columnas en la bd
        $columns = [
            'DNI' => 'use_dni',
            'Nombres y Apellidos' => 'use_nam',
            'Email' => 'email',
            'Nombre de Usuario' => 'use_nic',
            'Fecha Ingreso' => 'created_at',
            'Fecha Actualizado' => 'updated_at',
        ];
        $model='App\Models\Tatuco\User';

        /*$getDate=reqDate($request);
        echo $getDate;*/

        $query = DB::table('users')->select('use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at')
        ->get();

        return $this->reportService->report($request,$model, 'usuarios', $columns, 'Reporte de Usuarios');
    }

    public function prepPrueba(Request $request, User $user)
    {
        $columns = [
            'DNI' => 'use_dni',
            'Nombres y Apellidos' => 'use_nam',
            'Email' => 'email',
            'Nombre de Usuario' => 'use_nic',
            'Fecha Ingreso' => 'created_at',
            'Fecha Actualizado' => 'updated_at'
        ];

        $query = 'consulta';

        return $this->reportService->prepPrueba($request,'', $columns, $query, $user);

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
        $queryBuilder = (new User)->select(['use_dni','use_nam', 'email', 'use_nic', 'created_at', 'updated_at'])
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy($sortBy)
            ->get();
       //$queryBuilder = DB::table('users')->select('name','email','created_at')->get();

        // Set Column to be displayed
        $columns = [
            'DNI' => 'use_dni',
            'Nombres y Apellidos' => 'use_nam',
            'Email' => 'email',
            'Nombre de Usuario' => 'use_nic',
            'Fecha Ingreso' => 'created_at',
            'Fecha Actualizado' => 'updated_at' // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result

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