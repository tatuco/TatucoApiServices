<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

     public function types()
   {
   	 return $this->belongsTo('App\Models\Inventary\ProductType','product_type','id');
   }
   public function categories()
   {
   	 return $this->belongsTo('App\Models\Inventary\Category','category','id');
   }
    public function brands()
   {
   	 return $this->belongsTo('App\Models\Inventary\Brand','brand','id');
   }
     public function measures()
   {
     return $this->belongsTo('App\Models\Inventary\Measure','measure','id');
   }
}
