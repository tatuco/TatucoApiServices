<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
      protected $table = 'tax';

       public function operations()
    {
    	return $this->hasMany('App\Models\Inventary\Operation','tax','id');
    }
}
