<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\SupplierType;

class SupplierTypeService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'supplier_type';
        $this->model = new SupplierType();
        $this->namePlural = 'supplierTypes';
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