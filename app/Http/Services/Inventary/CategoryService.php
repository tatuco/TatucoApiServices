<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Category;

class CategoryService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'category';
        $this->model = new Category();
        $this->namePlural = 'categories';
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