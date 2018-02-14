<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Inventary;

class InventaryService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'inventary';
        $this->model = new Inventary();
        $this->namePlural = 'inventaries';
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