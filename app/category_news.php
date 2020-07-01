<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category_news extends Model
{
    protected $table = 'category_news';
    public $timestamps = false;
    public function news(){
        return $this->hasMany('App\news','id_category','id');
    }
}
