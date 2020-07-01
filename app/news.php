<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table = 'news';
    public $timestamps = true;

    public function category_news(){
        return $this->belongsTo('App\category_news','id_category','id');
    }
    public function user(){
        return $this->belongsTo('App\User','id_user','id');
    }
    public function comment(){
        return $this->hasMany('App\comment','id_news','id');
    }
}
