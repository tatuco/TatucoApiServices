<?php

namespace App\Http\Services\Tatuco;

use Caffeinated\Shinobi\Models\Role;

class RoleService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'role';
        $this->model = new Role();
        $this->namePlural = 'roles';
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