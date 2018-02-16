<?php

namespace App\Models\Tatuco;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Acl\Src\Traits\ShinobiTrait;
//use App\Notifications\ResetPassword;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

   /* public function __construct(){
        parent::__construct(User::class,'id','users',true,
        $create = [
            'name' => 'string',
            'emai' => 'string',
            'password' => 'string'
        ]);
    }*/
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
 /*   public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }*/
    /* public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }*/
    public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->name = $user->name.'usando evento creating';
        });
    }
}
