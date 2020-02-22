<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginPost;
use Illuminate\Support\Facades\Session;
use App\Model\UserLogin; 
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{

    protected $redirectTo = '/';

    public function index(){
        session()->put('test',url()->previous());
    	return view('mainsite.login.index');
    }
    public function handleLogin(StoreLoginPost $request,UserLogin $userlogin){
    	$username = $request->input('user',null);
    	// or $username = $request->user; (tro den du lieu gui len , tuc la bien name="user" trong view do)
    	$password = $request->input('pass',null);
    	//kiem tra trong csdl xem co ton tai khong
    	$infoUser = $userlogin->checkUserLogin($username, $password);
    	// dd($infoUser);  Complete
        // luu vao session 
        if ($infoUser) {
            $request->session()->put('tentaikhoan', $infoUser['tentaikhoan']);
            // $_SESSION['username'] = $infoAdmin['username']
            $request->session()->put('id', $infoUser['id']);
            $request->session()->put('so_dt', $infoUser['so_dt']);
            $request->session()->put('email', $infoUser['email']);
            $request->session()->put('anhdaidien', $infoUser['anhdaidien']);
            $request->session()->put('hoten', $infoUser['hoten']);
            $request->session()->put('status', $infoUser['status']);
            
            // dd(Session::get('test'). Session::get('backUrl'));
            // dd('abc');
            
            if ($this->redirectTo() != null) {
                return redirect($this->redirectTo());
            } else {
                return redirect()->route('trangchu');
            }

            
            // dd(Session::get('backUrl'));
        }else {
            return redirect()->route('login')->with('failed', 'Đăng nhập thất bại !, sai tài khoản hoặc mật khẩu');;
        }

    }
    public function handleLogout(Request $request)
    {
        $request->session()->forget('tentaikhoan');
        $request->session()->forget('id');
        $request->session()->forget('email');
        $request->session()->forget('hoten');
        $request->session()->forget('status');
        $request->session()->forget('backUrl');

        return redirect()->route('trangchu');
    }
    protected function redirectTo(){
        $this->redirectTo = Session::get('backUrl');
        return $this->redirectTo;
    }
}
