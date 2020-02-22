<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    //lam viec voi bang tin tuc
    protected $table = 'baiviet';

    // De su dung soft delete
    use SoftDeletes;

    public function exchangeDataArray($data){
    	//viet ham de chuyen object ve mang 
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }

    public function getAllDataNews()
    {
    	// return Post::all()->toArray(); //viet theo orm (model)
    	//ORM laravel 
    	//DB::table('posts')->get(); theo kieu query builder viet the nay
    	$data = News::select('id','tieu_de','noi_dung','anh_dd','id_dm','created_at','updated_at')
                    ->whereNull('deleted_at')
                    ->get();
    	return $data;
    }

    public static function getNewsTN()
    {
        
        $data = News::where('id_dm', 1)->get();
        $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }
    public static function getNewsQT()
    {
        
        $data = News::where('id_dm', 2)->get();
        $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }
    public static function getNewsDetail($id){
        $data = News::where('id',$id)->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }
    public static function getAllLatestNewsDESC(){
        $data = News::orderBy('created_at', 'desc')->take(4)->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }
    public function getNewsDetailWithCommentbyID($id_baiviet){
        $data = DB::table('baiviet')
                    ->join('binhluan', 'binhluan.id_baiviet', '=', 'baiviet.id')
                    ->join('nguoidung', 'binhluan.id_nguoidung', '=', 'nguoidung.id')
                    ->select(DB::raw(' id_baiviet, id_nguoidung, binhluan.noi_dung as noidung_binhluan, binhluan.created_at, binhluan.updated_at, tentaikhoan, anhdaidien'))
                    ->where('baiviet.id',$id_baiviet)
                    ->get();
        // $data = ($data) ? $data->toArray() : [] ;
        return $this->exchangeDataArray($data);
    }
    public static function getNewsWithSameCategory($id_dm){
        $data = News::where('id_dm', $id_dm)->take(4)->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }


}
