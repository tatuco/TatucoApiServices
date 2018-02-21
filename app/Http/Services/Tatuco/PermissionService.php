<?php

namespace App\Http\Services\Tatuco;

use Caffeinated\Shinobi\Models\Permission;

class PermissionService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'permission';
        $this->model = new Permission();
        $this->namePlural = 'permissions';
        //$this->paginate = 10;
    }

    //funcion que guarda registros
    public function store($request)
    {
        //llama a tatucoService
    	return $this->_store($request);
    }

    //funcion que actualiza registros
    public function update($id, $request)
    {
        //llama a tatucoService
    	return $this->_update($id, $request);
    }
	
}