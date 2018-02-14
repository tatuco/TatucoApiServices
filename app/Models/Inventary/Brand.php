<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $table = 'brand';
    protected $fillable = [
        'code', 'title', 'image','description','enable','disable'
    ];

    public function products()
   {
   	 return $this->hasMany('App\Models\Inventary\Product','product_type','id');
   }

}
