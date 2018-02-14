<?php
namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

       public function types()
   {
   	 return $this->belongsTo('App\Models\Inventary\SupplierType','supplier_type','id');
   }
}
