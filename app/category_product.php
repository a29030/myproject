<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_product extends Model
{
    protected $table = 'category_product';
    public $timestamps = false;

    public function products(){
        return $this->hasMany('App\product','id_category','id');
    }
}
