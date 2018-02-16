<?php

namespace App\Http\Services\Tatuco;

use App\Acl\Src\Models\Permission;

class PermissionService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'permission';
        $this->model = new Permission();
        $this->namePlural = 'permissions';
        //$this->paginate = 10;
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