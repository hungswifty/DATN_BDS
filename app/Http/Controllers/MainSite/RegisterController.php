<?php

namespace App\Http\Controllers\MainSite;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Users;

class RegisterController extends Controller
{
	private $dbUser;
	public function __construct(Users $user){
		$this->dbUser = $user;
	}
    public function index(){
    	return view('mainsite.register.index');
    }
    public function registerHandle(Request $request){
    	
    	Validator::make($request->all(), [
    			// yeu cau cua cac input trong form
		        'hoten' => 'required|max:40',
		        'email' => 'required|max:60',
		        'tentk' => 'required|max:60',
		        'password' => 'required|confirmed|max:60',
		        'gender' => 'required',
		        'diachi' => 'required',
		        'sodt' => 'required|max:11',
		        'socmnd' => 'required|max:12',
		    ],
		    [
		    	// noi dung thong bao ra view
		    	'hoten.required' => 'Tiêu đề không được để trống',
                'hoten.max' => 'Tiêu đề không được quá 300 kí tự',
		    	'email.required' => 'Tiêu đề không được để trống',
                'email.max' => 'Tiêu đề không được quá 300 kí tự',
                'tentk.required' => 'Tiêu đề không được quá 300 kí tự',
                'tentk.max' => 'Tiêu đề không được quá 300 kí tự',
                'password.required' => 'Tiêu đề không được quá 300 kí tự','hoten.required' => 'Tiêu đề không được để trống',
                'password.confirmed' => 'Nhập lại mật khẩu chưa trùng khớp',
                'password.max' => 'Tiêu đề không được quá 300 kí tự',
                'gender.required' => 'Vui lòng chọn giới tính của bạn',
                'diachi.required' => 'Vui lòng nhập địa chỉ của bạn',
                'socmnd.required' => 'Vui lòng nhập số CMND của bạn',
                'sodt.required' => 'Vui lòng nhập số điện thoại của bạn',
                'sodt.max' => 'Số điện thoại không quá 11 kí tự',
                'socmnd.max' => 'Số CMND không đúng',
		    ])->validate();
    	
    	// dd($request->all());


    	$hoten = $request->input('hoten');
    	$email = $request->input('email');
    	$tentk = $request->input('tentk');
    	$matkhau = $request->input('password');
    	$diachi = $request->input('diachi');
    	$gender = $request->input('gender');
    	$sodt = $request->input('sodt');
    	$socmnd = $request->input('socmnd');
    	

    	// Check if email or account existed
    	$checkAcc = $this->dbUser->checkAccountExisted($tentk); 
    	$checkEmail = $this->dbUser->checkEmailExisted($email);

    	$accExisted = count($checkAcc);
    	$emailExisted = count($checkEmail);

    	// if not, insert to DB
    	if ($accExisted == 0 && $emailExisted == 0) {
    		
    		$insert = DB::table('nguoidung')->insertGetId([
    			'tentaikhoan' => $tentk,
    			'matkhau' => $matkhau,
    			'email' => $email,
    			'hoten' => $hoten,
    			'anhdaidien' => null,
    			'gioitinh' => $gender,
    			'status' => 1,
    			'diachi' => $diachi,
    			'so_dt' => $sodt,
    			'so_cmnd' => $socmnd,
    			'created_at' => date('Y-m-d H:i:s'),
    			'updated_at' => null,
    		]);

            return back()->with('status-register', 'Đăng ký thành công');

    	} else {
    		if ($accExisted == 1) {
    			return back()->with('failed-register', 'Đăng ký thất bại,tên tài khoản đã được sử dụng');
    		} else {
    			return back()->with('failed-register', 'Email đã được sử dụng');
    		}
	           
	    }
    	
    }
}
