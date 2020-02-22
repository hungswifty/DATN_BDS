<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginPost;
//tro den namespace Request va chon class StoreLoginPost
use App\Model\Login; 
// Su dung model  vao trong controller

class LoginController extends Controller
{
    public function index(){
    	return view('admin.login.index'); // thu muc login -> vao file index
    }
    public function handleLogin(StoreLoginPost $request, Login $login){
    	// dd($request->all()); //check xem lay dc t.tin chua
    	$username = $request->input('user',null);
    	// or $username = $request->user; (tro den du lieu gui len , tuc la bien name trong view do)
    	$password = $request->input('pass',null);
    	//Validate form data
    	//kiem tra du lieu xem co ton tai trong database hay khong
    	$infoAdmin = $login->checkAdminLogin($username, $password);
    	//dd($infoAdmin);
    	if ($infoAdmin) {
    		$request->session()->put('username', $infoAdmin['username']);
    		// $_SESSION['username'] = $infoAdmin['username']
    		$request->session()->put('id', $infoAdmin['id']);
    		$request->session()->put('email', $infoAdmin['email']);
    		$request->session()->put('role', $infoAdmin['role']);
    		return redirect()->route('admin.dashboard');
    	}else {
    		return redirect()->route('admin.login',['state'=>'fail']);
    	}
    }
    public function logout(Request $request){
    	//xoa session
    	$request->session()->forget('username');
    	$request->session()->forget('id');
    	$request->session()->forget('email');
    	$request->session()->forget('role');
    	return redirect()->route('admin.login');
    }
}
