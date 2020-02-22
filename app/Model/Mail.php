<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mail extends Model
{

	protected $table = 'homthu';

    public function getAllMail()
    {
    	// return Post::all()->toArray(); //viet theo orm (model)
    	//ORM laravel 
    	//DB::table('posts')->get(); theo kieu query builder viet the nay
    	$data = Mail::paginate(10);
    	return $data;
    }

    public function getMailbyID($id){
        $data = Mail::where('id', $id)
                ->get();
        return $data;
    }

    public function getMailbyUserID($id_nguoidung){
    	$data = Mail::select(DB::raw('homthu.id, homthu.id_nguoidung, nguoigui , tieu_de, noi_dung, homthu.created_at, homthu.updated_at, homthu.is_deleted'))
    				->where('id_nguoidung', $id_nguoidung)
                    ->where('is_deleted', 0)
    				->join('nguoidung', 'homthu.id_nguoidung', '=', 'nguoidung.id')
                    ->orderBy('homthu.created_at', 'desc')
    				->paginate(10);
        // $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }

    public function getSentMail($id_nguoidung){
    	$data = Mail::select(DB::raw('homthu.id, homthu.id_nguoidung, nguoigui, tentaikhoan, tieu_de, noi_dung, homthu.created_at, homthu.updated_at'))
    				->where('nguoigui', $id_nguoidung)
    				->join('nguoidung', 'homthu.id_nguoidung', '=', 'nguoidung.id')
    				->paginate(10);
        // $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }
}
