<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    protected $table = 'nguoidung';
    use SoftDeletes;

    public static function checkAccountExisted($tentk){
    	$data = Users::where('tentaikhoan',$tentk)->get();
    	$data = ($data) ? $data->toArray() : [] ;
    	return $data;
    }

    public static function checkEmailExisted($email){
    	$data = Users::where('email', $email)->get();
    	$data = ($data) ? $data->toArray() : [] ;
    	return $data;
    }

    public static function getDataUser($id){
        $data = Users::where('id',$id)->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }
    public static function getDataCurrentAvatar($id){
        $data = Users::select('anhdaidien')
                    ->where('id', $id)
                    ->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }
    public static function checkPassword($id, $pw){
        $data = Users::where('id', $id)
                    ->where('matkhau', $pw)
                    ->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }

    public static function getIDbyAccName($tentk){
        $data = Users::select('id')
                    ->where('tentaikhoan',$tentk)->get();
        $data = ($data) ? $data->toArray() : [] ;
        return $data;
    }


}
