<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'fle_id';
    protected $table ="fleets";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'fle_id', 'fle_des', 'use_nic', 'fle_act', 'acc_id'
    ];
}
