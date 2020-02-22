<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserLogin extends Model
{
    protected $table = 'nguoidung';

     public function exchangeDataArray($data){
    	//viet ham de chuyen object ve mang
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }

    public function checkUserLogin($user, $pass)
    {
    	$data = UserLogin::where([
    		'tentaikhoan' => $user,
    		'matkhau' => $pass,
    		'status' => 1
     	])->first();

     	return $this->exchangeDataArray($data);
    }


}
