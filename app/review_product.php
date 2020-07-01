<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review_product extends Model
{
    protected $table = 'review_product';
    public function users(){
        return $this->hasOne('App\users','id','id_user');
    }
}
