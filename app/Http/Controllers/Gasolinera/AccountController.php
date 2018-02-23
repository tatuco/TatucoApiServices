<?php

namespace App\Http\Controllers\Gasolinera;

use App\Http\Controllers\Tatuco\TatucoController;
use App\Http\Services\Gasolinera\AccountService;
use App\Models\Gasolinera\Account;
use Illuminate\Http\Request;

class AccountController extends TatucoController
{
    public function __construct()
    {
        $this->service = new AccountService();
        $this->campo = 'acc_id';//llave primaria
        $this->status = 'acc_act';//campo de activo o eliminado
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
        return $this->service->update($this->campo, $dato, $this->status, $request);
    }

}
