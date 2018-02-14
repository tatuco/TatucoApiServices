<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\EmployeeType;

class EmployeeTypeService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'employee_type';
        $this->model = new EmployeeType();
        $this->namePlural = 'employeeTypes';
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