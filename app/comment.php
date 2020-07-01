<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comment';
    public function user(){
        return $this->belongsTo('App\User','id_user','id');
    }
    public function news(){
        return $this->belongsTo('App\news','id_news','id');
    }
}
