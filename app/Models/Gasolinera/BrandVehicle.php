<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class BrandVehicle extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'bra_id';
    protected $table ="brands_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'bra_id', 'bra_des', 'use_nic', 'bra_act', 'acc_id'
    ];
}
