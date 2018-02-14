<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class SupplierType extends Model
{
     protected $table = 'supplier_type';

      public function suppliers()
   {
   	 return $this->hasMany('App\Models\Inventary\Supplier','supplier_type','id');
   }
}
