<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table = 'permission';
    public $timestamps = false;
    public function group_user(){
        return $this->belongsToMany('App\group_user','role_permission','id_permission','id_group');
    }
}
