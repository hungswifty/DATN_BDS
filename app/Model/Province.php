<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'tinhthanh';

    public function district()
    {
        return $this->hasMany('App\Model\District');
    }
}
