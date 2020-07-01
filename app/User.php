<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function user_information(){
        return $this -> hasOne('App\user_information','id','id');
    }
    public function comment(){
        return $this->hasMany('App\comment','id_user','id');
    }
    public function news(){
        return $this->hasMany('App\news','id_user','id');
    }
    public function product(){
        return $this->hasMany('App\product','id_user','id');
    }
    public function group_user(){
        return $this->hasOne('App\group_user','id','id_group');
    }
    public function review_product(){
        return $this->hasMany('App\review_product','id_user','id');
    }
}
