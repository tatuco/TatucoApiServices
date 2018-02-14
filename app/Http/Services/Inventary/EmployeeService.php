<?php

namespace App\Http\Services\Inventary;
use App\Http\Services\Tatuco\TatucoService;
use App\Models\Inventary\Employee;

class EmployeeService extends TatucoService
{
	public function __construct()
    {
        $this->name = 'employee';
        $this->model = new Employee();
        $this->namePlural = 'employees';
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