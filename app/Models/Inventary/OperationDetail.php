<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class OperationDetail extends Model
{
    protected $table = 'operation_detail';

      public function products()
    {
    	return $this->belongsTo('App\Models\Inventary\products','product','id');
    }
}
