<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\ProductType;

class ProductTypeService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'product_type';
        $this->model = new ProductType();
        $this->namePlural = 'product_types';
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