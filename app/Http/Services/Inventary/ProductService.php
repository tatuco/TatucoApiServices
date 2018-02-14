<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Product;

class ProductService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'product';
        $this->model = new Product();
        $this->namePlural = 'products';
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