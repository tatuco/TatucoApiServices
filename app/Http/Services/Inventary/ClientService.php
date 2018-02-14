<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Client;

class ClientService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'client';
        $this->model = new Client();
        $this->namePlural = 'clients';
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