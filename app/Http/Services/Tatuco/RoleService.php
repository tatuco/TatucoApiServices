<?php

namespace App\Http\Services\Tatuco;

use App\Acl\Src\Models\Role;

class RoleService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'role';
        $this->model = new Role();
        $this->namePlural = 'roles';
    }

    public function store($request)
    {
    	return $this->_store($request);
    }

    public function update($id, $request)
    {
    	return $this->_update($id, $request);
    }
	
}