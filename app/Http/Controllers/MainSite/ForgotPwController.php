<?php

namespace App\Http\Controllers\MainSite;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Mailer;
use App\Model\Users;
use Illuminate\Support\Str;

class ForgotPwController extends Controller
{
	public $content = 'abc';
	private $userMail;
    
	public function __construct(Users $user){
		$this->userMail = $user;
	}

    public function index(){
    	return view('mainsite.login.forgotpw');
    }

    public function handle(Request $request){

    	$emailInput = $request->input('email_address');
    	
    	$checkEmail = $this->userMail->checkEmailExisted($emailInput);
    	$existOrNot = count($checkEmail);
        
    	if ($existOrNot == 1) {
    		$update = DB::table('nguoidung')
    					->where('email',$emailInput)
    					->update([
    						'matkhau' => Str::random(10),
    						'updated_at' => date('Y-m-d H:i:s')
    					]);
    	    
            $getDataAfterUpdate = $this->userMail->checkEmailExisted($emailInput);

            Mail::send('mainsite.mail.forgotPW',['userDT' => $getDataAfterUpdate], function ($message) use ($emailInput) {
                $message->from('timnha3mien@gmail.com', 'Tìm nhà 3 miền');

                $message->to($emailInput)->subject('Thay đổi mật khẩu đăng nhập !');

            });

            return back()->with('status', 'Hãy kiểm tra hòm thư, một email đã được gửi đến kèm với mật khẩu mới !');

        } else {
            return back()->with('failed', 'Email này chưa được đăng ký');
        }
 
    }
}
