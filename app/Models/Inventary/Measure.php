<?php

namespace App\Models\Inventary;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = 'measure';

     public function products()
   {
   	 return $this->hasMany('App\Models\Inventary\Product','measure','id');
   }

}
