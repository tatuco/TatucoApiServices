<?php

namespace App\Http\Controllers\Gasolinera;

use Illuminate\Http\Request;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Gasolinera\DriverService;
use App\Models\Gasolinera\Status;

class DriverController extends TatucoController
{
    public function __construct()
    {
        $this->service = new DriverService();
        $this->campo = 'dri_dni';//llave primaria
        $this->status = 'dri_act';//campo de activo o eliminado
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
