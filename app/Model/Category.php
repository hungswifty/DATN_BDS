<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'dmbaiviet';

    public function news(){
    	return $this->hasMany('App\Model\News');
    }
}
