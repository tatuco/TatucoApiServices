<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\ClientType;

class ClientTypeService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'client_type';
        $this->model = new ClientType();
        $this->namePlural = 'clientTypes';
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