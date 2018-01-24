<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends TatucoController
{
    public function __construct()
    {
        $this->name = 'role';
        $this->model = new Role();
        $this->namePlural = 'roles';
        //$this->paginate = 10;
    }

    public function store(Request $request)
    {

        $this->request = $request;

        return $this->_store();
    }

    public function update($id, Request $request)
    {

        $this->request = $request;
        return $this->_update($id);
    }
}
