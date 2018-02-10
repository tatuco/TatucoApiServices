<?php

namespace App\Models\Tatuco;

use Illuminate\Notifications\Notifiable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends TatucoModel
{
    use Notifiable, ShinobiTrait;

    public function __construct(){
        parent::__construct(User::class,'id','users',true,
        $create = [
            'name' => 'string',
            'emai' => 'string',
            'password' => 'string'
        ]);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
