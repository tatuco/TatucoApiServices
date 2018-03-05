<?php

namespace App\Http\Controllers\Tatuco;
use App\Http\Services\Tatuco\TatucoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\Controller;
use App\Http\Services\Tatuco\ReportService;
class TatucoController extends Controller
{
    //atributos
    public $service;
    public $tatucoService;
    public $reportService;
    public $columns;
    public $campo;
    public $status;
    public $validate;

    public function __construct(TatucoService $tatucoService, ReportService $reportService){
        $this->tatucoService = $tatucoService;
        $this->reportService = $reportService;
    }

    //funcion que muestra los registros
    public function index()
    {
        //llamo al tatucoService
        return $this->service->_index($this->status);
    }
    //funcion que muestra los registros por el id
    public function show($dato)
    {
        //llamo al tatucoService
        return $this->service->_show($this->campo, $dato, $this->status);
    }

    //funcion que guarda los registros
    public function _store()
    {
        //llamo al tatucoService
        return $this->service->_store();
    }

    //funcion que actualiza los registros
    public function _update($dato)
    {
        //llamo al tatucoService
       return $this->service->_update($this->campo, $dato, $this->status);
    }

    //funcion que elimina los registros
    public function destroy($dato)
    {
        //llamo al tatucoService
        return $this->service->_destroy($this->campo, $dato, $this->status);
    }

    public function create(){
        //llamo al tatucoService
        return $this->service->create(); 
    }

    public function prueba(Request $request){
        //llamo al tatucoService
        return $this->service->prueba($request);
    }

    public function backup(){
        //llamo al tatucoService
        return $this->tatucoService->backup();
    }

    public function report(Request $request){
        //llamo al tatucoService
        return $this->service->report($request, $this->columns);
    }

}
