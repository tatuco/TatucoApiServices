<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Brand;

class BrandService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'brand';
        $this->model = new Brand();
        $this->namePlural = 'brands';
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