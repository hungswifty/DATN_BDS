<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Images extends Model
{
    protected $table = 'hinhanh';
    use SoftDeletes;

    public function exchangeDataArray($data){
    	//viet ham de chuyen object ve mang 
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }
    public static function getImagebyProductIDforHP(){
    	$data = DB::table('hinhanh')
                     ->select('id_sanpham','nguon_anh')
                     ->groupBy('id_sanpham')
                     ->get(); //ket qua tra ve la doi tuong nen phai doi ra array
        return $this->exchangeDataArray($data);
    }

    // public static function getImagebyProductIDforHP(){
    // 	$data = Images::where('nguon_anh', $id)->get();
    //     $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
    //     return $data;
    // }

    public static function getImagebyProductID($id)
    {
        $data = Images::where('nguon_anh', $id)->get();
        $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }

    public static function getAllDataImageforAdmin()
    {
        $data = DB::table('hinhanh')
                    ->whereNull('deleted_at')
                    ->get();
        
        return $data;
    }

    public static function getImageDetail($id)
    {
         $data = DB::table('hinhanh')->where('id', $id)->get();

         return $data;
    }
}
