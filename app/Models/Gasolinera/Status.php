<?php

namespace App\Models\Gasolinera;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $timestamps = true;
    protected $primaryKey = 'sta_id';
    protected $table ="status";
    protected $fillable = [
        //mapeo de columnas de la base de datos
        'sta_id', 'sta_des', 'sta_tab', 'use_nic', 'sta_act', 'acc_id'
    ];
}
