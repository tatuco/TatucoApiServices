<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\OperationDetail;

class OperationDetailService extends TatucoService
{

	public function __construct()
    {
        $this->name = 'operation_detail';
        $this->model = new OperationDetail();
        $this->namePlural = 'operation_details';
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