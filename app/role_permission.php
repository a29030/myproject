<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_permission extends Model
{
    protected $table = 'role_permission';
    public $timestamps = false;
    public function role_permission(){
        return $this->hasOneThrough('App\permission','App\group_user','id_permission',
            'id_group','id','id');
    }
}
