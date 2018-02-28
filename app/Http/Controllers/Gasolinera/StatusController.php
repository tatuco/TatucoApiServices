<?php

namespace App\Http\Controllers\Gasolinera;

use Illuminate\Http\Request;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Gasolinera\StatusService;
use App\Models\Gasolinera\Status;

class StatusController extends TatucoController
{
    public function __construct()
    {
        $this->service = new StatusService();
        $this->campo = 'sta_id';//llave primaria
        $this->status = 'sta_act';//campo de activo o eliminado
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
        return $this->service->update($dato, $this->status, $request);
    }

}
