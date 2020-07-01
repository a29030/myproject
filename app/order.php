<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';
    public function status_order(){
        return $this->belongsTo('App\status_order','id_status','id');
    }
    public function order_detail(){
        return $this->hasMany('App\order_detail','id_order','id');
    }
}
