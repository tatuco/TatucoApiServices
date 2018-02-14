<?php

namespace App\Models\Inventary;
use Illuminate\Database\Eloquent\Model;

class EmployeeType extends Model
{
    protected $table = 'employee_type';

     public function employees()
   {
   	 return $this->hasMany('App\Models\Inventary\Employee','employee_type','id');
   }
}
