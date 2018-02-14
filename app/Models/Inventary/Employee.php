<?php
namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  protected $table = 'employee';

   public function types()
   {
   	 return $this->belongsTo('App\Models\Inventary\EmployeeType','employee_type','id');
   }
}
