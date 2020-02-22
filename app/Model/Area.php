<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $table = 'khuvuc';

    public function province()
    {
        return $this->hasMany('App\Model\Province');
    }

    public static function getAllAPDdata(){
    	$data = DB::table('khuvuc')
    			->join('tinhthanh', 'tinhthanh.id_khuvuc', '=', 'khuvuc.id')
                ->join('quanhuyen', 'quanhuyen.id_tinhthanh', '=','tinhthanh.id')
                ->select(DB::raw('khuvuc.id as id_khuvuc, tinhthanh.id as id_tinhthanh, quanhuyen.id as id_quanhuyen, ten_khuvuc, ten_tinhthanh, ten_quanhuyen'))
                ->get();
        return $data;
    }
}
