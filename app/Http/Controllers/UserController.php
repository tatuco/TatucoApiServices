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
        $this->paginate = 10;
    }

    public function store(Request $request)
    {
        $pass = bcrypt($request->json(['password']));
        $request->merge(['password' => $pass]);
        $this->request = $request;

        return $this->_store();
    }

    public function update($id, Request $request)
    {
        if($request->json(['password'])){
           $pass = bcrypt($request->json(['password']));
           $request->merge(['password' => $pass]);
        }
        $this->request = $request;
        return $this->_update($id);
    }
}
