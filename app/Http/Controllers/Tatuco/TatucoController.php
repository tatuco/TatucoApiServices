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

    public function __construct(TatucoService $tatucoService, ReportService $reportService){
        $this->tatucoService = $tatucoService;
        $this->reportService = $reportService;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function _store()
    {
        return $this->service->store();
    }

    public function _update($id)
    {
       return $this->service->update($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
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
