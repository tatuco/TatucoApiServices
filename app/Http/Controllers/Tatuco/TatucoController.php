<?php

namespace App\Http\Controllers\Tatuco;
use App\Http\Services\Tatuco\TatucoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Tatuco\Controller;
use App\Http\Services\Tatuco\ReportService;
class TatucoController extends Controller
{
    public $service;
    public $tatucoService;
    public $reportService;
    public $columns;
    public $campo;
    public $status;
    public $account;

    public function __construct(TatucoService $tatucoService, ReportService $reportService){
        $this->tatucoService = $tatucoService;
        $this->reportService = $reportService;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($dato)
    {
        return $this->service->show($this->campo, $dato, $this->status, $this->account);
    }

    public function _store()
    {
        return $this->service->store();
    }

    public function _update($id)
    {
       return $this->service->update($id);
    }

    public function destroy($dato)
    {
        return $this->service->destroy($this->campo, $dato, $this->status, $this->account);
    }

    public function create(){
        return $this->service->create(); 
    }

    public function prueba(Request $request){
        return $this->service->prueba($request);
    }

    public function backup(){
        return $this->tatucoService->backup();
    }

    public function report(Request $request){
        return $this->service->report($request, $this->columns);
    }

}
