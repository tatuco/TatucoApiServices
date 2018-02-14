<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $table = 'operation';

    public function taxs()
    {
    	return $this->belongsTo('App\Models\Inventary\Tax','tax','id');
    }

    public function clients()
    {
    	return $this->belongsTo('App\Models\Inventary\Client','client','id');
    }
    public function employees()
    {
    	return $this->belongsTo('App\Models\Inventary\Employee','employee','id');
    }
    public function types()
    {
    	return $this->belongsTo('App\Models\Inventary\OperationType','operation_type','id');
    }
     public function details()
    {
        return $this->hasMany('App\Models\Inventary\OperationDetail','operation','id');
    }
}
