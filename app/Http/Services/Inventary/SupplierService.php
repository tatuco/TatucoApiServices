<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Supplier;

class SupplierService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'supplier';
        $this->model = new Supplier();
        $this->namePlural = 'suppliers';
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