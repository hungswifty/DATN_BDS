<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; //them vao de viet theo kieu query builder


class Login extends Model
{
	//lam viec voi bang admins
    protected $table = 'admins';

    public function exchangeDataArray($data){
    	//viet ham de chuyen object ve mang 
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }

    public function checkAdminLogin($user, $pass)
    {
    	$data = Login::where([
    		'username' => $user,
    		'password' => $pass, //kiem tra du lieu truyen vao co giong trong csdl khong
    		'status' => 1,
    		'role' => 1
     	])->first();

     	return $this->exchangeDataArray($data);
    }

}
