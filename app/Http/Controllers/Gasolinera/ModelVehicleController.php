<?php

namespace App\Http\Controllers\Gasolinera;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Gasolinera\ModelVehicleService;
use Illuminate\Http\Request;

class ModelVehicleController extends TatucoController
{
    public function __construct()
    {
        $this->service = new ModelVehicleService();
        $this->campo = 'mod_id';//llave primaria
        $this->status = 'mod_act';//campo de activo o eliminado
    }

    //funcion que guarda los registros
    public function store(Request $request)
    {
        //llama a userService
        return $this->service->store($request);
    }

    //funcion que actualiza los registros
    public function update($dato, Request $request)
    {
        //llama a userService
        return $this->service->update($this->campo,$dato, $this->status, $request);
    }
}
