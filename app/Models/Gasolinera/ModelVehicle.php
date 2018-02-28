<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class ModelVehicle extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'mod_id';
    protected $table ="models_vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'mod_id', 'bra_id', 'use_nic', 'mod_des', 'bra_act', 'acc_id'
    ];
}
