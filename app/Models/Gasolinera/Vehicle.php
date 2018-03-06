<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public $timestamps = true;
    public $incrementing = false;
    protected $primaryKey = 'veh_pla';
    protected $table ="vehicles";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'veh_pla', 'veh_com', 'use_nic', 'veh_des', 'tve_id', 'fle_id', 'mod_id', 'sta_id', 'veh_ass', 'veh_act', 'acc_id'
    ];
}
