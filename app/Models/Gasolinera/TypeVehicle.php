<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'tve_id';
    protected $table ="type_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'tve_id', 'tve_des', 'use_nic', 'tve_act', 'acc_id'
    ];
}
