<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Measure;

class MeasureService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'masure';
        $this->model = new Measure();
        $this->namePlural = 'measures';
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