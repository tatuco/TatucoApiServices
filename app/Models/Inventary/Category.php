<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'category';
    protected $fillable = [
        'code', 'title','description','enable','disable'
    ];

     public function products()
   {
   	 return $this->hasMany('App\Models\Inventary\Product','product_type','id');
   }
}
