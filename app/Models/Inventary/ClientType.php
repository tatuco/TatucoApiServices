<?php

namespace App\Models\Inventary;

use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    protected $table = 'client_type';

    public function clients()
    {
    	return $this->hasMany('App\Models\Inventary\ClientType', 'id','client_type');
    }
}
