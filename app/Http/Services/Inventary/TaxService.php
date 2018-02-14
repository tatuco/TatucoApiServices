<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Tax;

class TaxService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'tax';
        $this->model = new Tax();
        $this->namePlural = 'taxs';
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