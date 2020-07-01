<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group_user extends Model
{
    protected $table = 'group_user';
    public $timestamps = false;
    public function user(){
        return $this->belongsTo('App\User','id_user','id');
    }
    public function permission(){
        return $this->belongsToMany('App\permission','role_permission','id_group','id_permission');
    }
}
