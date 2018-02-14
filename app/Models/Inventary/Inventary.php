<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    protected $table = 'inventary';

    public function products()
    {
    	return $this->belongsTo('App\Models\Inventary\Products');
    }
}
