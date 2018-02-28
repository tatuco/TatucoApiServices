<?php

namespace app\Http\Services\Gasolinera;

use App\Models\Gasolinera\Driver;
use App\Http\Services\Tatuco\TatucoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DriverService extends TatucoService
{
    public function __construct()
    {
        $this->name = 'driver';
        $this->model = new Driver();
        $this->namePlural = 'drivers';
    }

    //funcion que guarda registros
    public function index($status)
    {
        //llama a tatucoService
        return $this->_index($status);
    }

    //guardar datos
    public function store($request)
    {
        //envio a tatuco service
        return $this->_store($request);
    }

    //actualizar
    public function update($campo, $dato, $status, Request $request)
    {
        //envio a tatuco service
        return $this->_update($campo, $dato, $status, $request);
    }

    //eliminar
    public function destroy($campo, $dato, $status)
    {
        //llama a tatucoService
        return $this->_destroy($campo, $dato, $status);
    }
}