<?php

namespace App\Http\Controllers\Gasolinera;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Gasolinera\BrandVehicleService;
use Illuminate\Http\Request;

class BrandVehicleController extends TatucoController
{
    public function __construct()
    {
        $this->service = new BrandVehicleService();
        $this->campo = 'bra_id';//llave primaria
        $this->status = 'bra_act';//campo de activo o eliminado
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