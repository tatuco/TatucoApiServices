<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TatucoController;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class UserController extends TatucoController
{
    use RegistersUsers;
    /**
     * UserController constructor.
     * construimos los atributos que usara TatucoController
     */
    public function __construct()
    {
        $this->name = 'user';
        $this->model = new User();
        $this->namePlural = 'users';
    }

    public function store(Request $request)
    {
        $request->password = bcrypt($request->password);
        $this->request = $request;

        return $this->_store();
    }

    public function update($id, Request $request)
    {
        $this->request = $request;
        return $this->_update($id);
    }
}
