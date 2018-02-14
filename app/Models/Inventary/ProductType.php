<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
  protected $table = 'product_type';

    public function products()
   {
   	 return $this->hasMany('App\Models\Inventary\Product','product_type','id');
   }
}
