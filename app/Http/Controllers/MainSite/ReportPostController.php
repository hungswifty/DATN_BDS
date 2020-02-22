<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportPostController extends Controller
{
    public function handleReport(Request $request){
    	$result = $request->method();
    	
    	//get serializeArray() data
    	$dataForm = $request->postData;
    	$dataDecoded = json_decode($dataForm, true);
  	 
    	$id_sanpham = $request->input('id_sanpham');
    	
    	//khi da dang nhap
    	if (session()->has('tentaikhoan')) {
    		$sess_email = session()->get('email');
    		$sess_so_dt = session()->get('so_dt');
    		$noi_dung = $dataDecoded[2]['value'];

    		$insert = DB::table('phanhoi')->insertGetId([
    			'id_sanpham' => $id_sanpham,
    			'noi_dung' => $noi_dung,
    			'email' => $sess_email,
    			'so_dt' => $sess_so_dt,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => null
    		]);
    	} else {
    		//khi chua dang nhap
    		$email = $dataDecoded[0]['value'];
    		$so_dt = $dataDecoded[1]['value'];
    		$noi_dung = $dataDecoded[2]['value'];

    		$insert = DB::table('phanhoi')->insertGetId([
    			'id_sanpham' => $id_sanpham,
    			'noi_dung' => $noi_dung,
    			'email' => $email,
    			'so_dt' => $so_dt,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => null
    		]);
    	}

    	if ($insert) {
    		echo 'Gửi thành công';
    	} else {
    		echo 'Gửi thất bại';
    	}

    	// print_r($dataDecoded);
    }
}
