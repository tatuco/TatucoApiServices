<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $table = 'client';

   public function types()
   {
   	 return $this->belongsTo('App\Models\Inventary\ClientType','client_type','id');
   }
}
