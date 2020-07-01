<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class status_order extends Model
{
    protected $table = 'status_order';
    public $timestamps = false;
    public function order(){
        return $this->hasOne('App\order','id_status','id');
    }

}
