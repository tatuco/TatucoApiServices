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
        $this->validate = [//campo de validaciones
            'acc_enc' => 'required',
            'acc_id' => 'required',
            'acc_des' => 'required',
            'acc_dir' => 'required',
            'acc_nom' => 'required',
            'acc_ruc' => 'required',
            'acc_pho' => 'required',
        ];
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
