<?php

namespace App\Http\Controllers\Tatuco;


use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends TatucoController
{
    public function __construct()
    {
        $this->name = 'permission';
        $this->model = new Permission();
        $this->namePlural = 'permissions';
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
