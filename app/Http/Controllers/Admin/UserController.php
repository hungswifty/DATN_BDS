<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use App\Model\Users;
use Validator;


class UserController extends Controller
{
	private $dbUser;

	public function __construct(Users $user){
		$this->dbUser = $user;
	}

    public function addUserIndex(){
    	return view('admin.user.adduser');
    }

    public function addUserHandle(Request $request){
    	// dd($request->all());
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
    	// dd($accExisted.' '.$emailExisted);
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

            return back()->with('status-addUser', 'Thêm mới thành công');

    	} else {
    		if ($accExisted == 1) {
    			return back()->with('failed-addUser', 'Tài khoản đã được sử dụng');
    		} else {
    			return back()->with('failed-addUser', 'Email đã được sử dụng');
    		}
	           
	    }


    }

    public function displayAllUser(){
    	
    	return view('admin.user.displayall');
    }

    public function dataForDisplayAllUser(){
    	$data = DB::table('nguoidung')->whereNull('deleted_at')->get();

    	return Datatables::of($data)
    						->addColumn('edit', function ($data) {
                                    return  '<a href="' . route('admin.edit-user-details', $data->id) .'">'.'<button type="button" class="btn btn-outline-info" title="Sửa" >Sửa</button></a>';
                            })
                            ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-user', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa người dùng có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
    						->editColumn('anhdaidien', function($data){
                                    if($data->anhdaidien != null) return '<img src="../' .$data->anhdaidien.'"' .'alt="Ảnh" width="50" height="50">';
                                    if($data->anhdaidien == null) return '<img src="../upload/user/person-icon.png"' .'alt="Ảnh" width="50" height="50">';
                            })
                            ->editColumn('status', function($data){
                                    if($data->status == 1) return 'Kích hoạt';
                                    if($data->status == 0) return 'Vô hiệu';
                            })
                            ->editColumn('gioitinh', function($data){
                                    if($data->status == 1) return 'Nam';
                                    if($data->status == 0) return 'Nữ';
                            })
    						->rawColumns(['edit' => 'edit','anhdaidien' => 'anhdaidien','delete' => 'delete'])
    						->make(true);
    }

    public function editUserDetail($user_id){
    	$dataUser = DB::table('nguoidung')->where('id', '=', $user_id)->get();
    	// dd($dataUser);
    	return view('admin.user.edituser')->with('data',$dataUser);
    }
    public function editUserHandle(Request $request){
    	// dd($request->all());
    	Validator::make($request->all(), [
    			// yeu cau cua cac input trong form
		        'hoten' => 'required|max:40',
		        'email' => 'required|max:60',
		        'tentk' => 'required|max:60',
		        'gender' => 'required',
		        'diachi' => 'required',
		        'sodt' => 'required|max:11',
		        'socmnd' => 'required|max:12',
		        'avatar' => 'mimes:jpg,jpeg,png,bmp,tiff|max:4096'
		    ],
		    [
		    	// noi dung thong bao ra view
		    	'hoten.required' => 'Tiêu đề không được để trống',
                'hoten.max' => 'Tiêu đề không được quá 300 kí tự',
		    	'email.required' => 'Tiêu đề không được để trống',
                'email.max' => 'Tiêu đề không được quá 300 kí tự',
                'tentk.required' => 'Tiêu đề không được quá 300 kí tự',
                'tentk.max' => 'Tiêu đề không được quá 300 kí tự',
                'gender.required' => 'Vui lòng chọn giới tính của bạn',
                'diachi.required' => 'Vui lòng nhập địa chỉ của bạn',
                'socmnd.required' => 'Vui lòng nhập số CMND của bạn',
                'sodt.required' => 'Vui lòng nhập số điện thoại của bạn',
                'sodt.max' => 'Số điện thoại không quá 11 kí tự',
                'socmnd.max' => 'Số CMND không đúng',
                'avatar.mimes' => 'Yêu cầu chọn đúng định dạng file ảnh JPG, JPEG, PNG, BMP',
                'avatar.max' => 'Kích cỡ file vượt quá 4MB',
		    ])->validate();

    	$idUser = $request->input('id_nguoidung');
    	$status = $request->input('trang_thai');
    	$tentaikhoan = $request->input('tentk');
    	$email = $request->input('email');
    	$ho_ten = $request->input('hoten');
    	$gioi_tinh = $request->input('gender'); 
    	$dia_chi = $request->input('diachi');
    	$so_cmnd = $request->input('socmnd');
    	$so_dt = $request->input('sodt');


    	$currentAvatar = $this->dbUser->getDataCurrentAvatar($idUser)[0]['anhdaidien'];

    	

    	if ($request->hasFile('avatar')) {
    		$file = $request->file('avatar');
    		// Lay ten + duoi file
    		$fileName = Str::slug($file->getClientOriginalName(),'-');
    		
    		$file->move('upload/user', $fileName);
    		
    		$updateUser = DB::table('nguoidung')
                        ->where('id',$idUser)
                        ->update([
                            'hoten' => $ho_ten,
                            'tentaikhoan' => $tentaikhoan,
                            'email' => $email,
                            'gioitinh' => $gioi_tinh,
                            'anhdaidien' => 'upload/user/'.$fileName,
                            'diachi' => $dia_chi,
                            'so_dt' => $so_dt,
                            'so_cmnd' => $so_cmnd,
                            'status' => $status,
                            'updated_at' => date('Y-m-d H:i:s'),
             ]);
    	} else {
    		$updateUser = DB::table('nguoidung')
                        ->where('id',$idUser)
                        ->update([
                            'hoten' => $ho_ten,
                            'tentaikhoan' => $tentaikhoan,
                            'email' => $email,
                            'gioitinh' => $gioi_tinh,
                            'anhdaidien' => $currentAvatar,
                            'diachi' => $dia_chi,
                            'so_dt' => $so_dt,
                            'so_cmnd' => $so_cmnd,
                            'status' => $status,
                            'updated_at' => date('Y-m-d H:i:s'),
             ]);
    	}

    	if($updateUser){
            return back()->with('ADstatus-editUser', 'Cập nhật thông tin thành công');
        }else {
            return back()->with('ADfailed-editUser', 'Cập nhật thông tin thất bại');
        }

    }

    public function deleteUser($user_id){
    	
    	$userDetail = $this->dbUser->find($user_id);

    	// dd($productDetail);
        $userDel = $userDetail->delete();
        
        // dd($userDel);

        if ($userDel) {
            return back()->with('ADsuccess-delUser', 'Xóa thành công');
        }else {
            return back()->with('ADfailed-delUser', 'Xóa thất bại');
        }
    }

    public function restoreUser(){
    	$userDetail = $this->dbUser->withTrashed();
        $userRestore = $userDetail->restore();
        if ($userRestore) {
            return back();
        }
    }
}
