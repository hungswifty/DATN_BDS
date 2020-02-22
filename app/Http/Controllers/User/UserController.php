<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Users;
use App\Model\Product;
use App\Model\Mail;
use Validator;
use Str;

class UserController extends Controller
{
	private $dbUser;
	private $dbProduct;
	private $dbMail;


	public function __construct(Users $user, Product $product, Mail $mail){
		$this->dbUser = $user;
		$this->dbProduct = $product;
		$this->dbMail = $mail;
	}
    public function index()
    {
        // dd('abc');
    	$dataUser = $this->dbUser->getDataUser(session()->get('id'));
        // dd(session()->get('id'));
    	if ($dataUser) {
    		return view('mainsite.user.index')->with('data', $dataUser);
    	}
    	
    }
    public function changeInfo(){
    	$dataUser = $this->dbUser->getDataUser(session()->get('id'));

    	return view('mainsite.user.changeInfo')->with('data', $dataUser);    
    }

    public function changeInfoHandle(Request $request){
        // dd($request->gioi_tinh);
    	Validator::make($request->all(), [
                // yeu cau cua cac input trong form
            'ho_ten' => 'required',
            'dia_chi' => 'required',
            'so_cmnd' => 'required|max:12',
            'so_dt' => 'required|max:10',
    		'avatar' => 'mimes:jpg,jpeg,png,bmp,tiff|max:4096',

    	],
    	[
                // noi dung thong bao ra view
           	'ho_ten.required' => 'Họ tên không được bỏ trống',
           	'dia_chi.required' => 'Địa chỉ không được bỏ trống',
           	'so_cmnd.required' => 'Số CMND không được bỏ trống',
           	'so_cmnd.max' => 'Số CMND không hợp lệ',
           	'so_dt.max' => 'Số điện thoại không hợp lệ',
           	'so_dt.required' => 'Số điện thoại không được bỏ trống',
    		'avatar.mimes' => 'Yêu cầu chọn đúng định dạng file ảnh JPG, JPEG, PNG, BMP',
    	])->validate();

    	$idUser = session()->get('id');
    	$ho_ten = $request->input('ho_ten');
    	$gioi_tinh = $request->input('gioi_tinh'); 
    	$dia_chi = $request->input('dia_chi');
    	$so_cmnd = $request->input('so_cmnd');
    	$so_dt = $request->input('so_dt');

        // dd($gioi_tinh);
    	//ket qua ra mang? nen phai chieu den value do tai key anhdaidien
    	$currentAvatar = $this->dbUser->getDataCurrentAvatar($idUser)[0]['anhdaidien'];

    	if ($request->hasFile('avatar')) {

    		// dd($request->all());
    		$file = $request->file('avatar');
    		// Lay ten + duoi file
    		$fileName = Str::slug($file->getClientOriginalName(),'-');
    		// Luu vao upload
    		$file->move('upload/user', $fileName);

            $update = DB::table('nguoidung')
                        ->where('id',$idUser)
                        ->update([
                            'hoten' => $ho_ten,
                            'gioitinh' => $gioi_tinh,
                            'anhdaidien' => 'upload/user/'.$fileName,
                            'diachi' => $dia_chi,
                            'so_dt' => $so_dt,
                            'so_cmnd' => $so_cmnd,
                            'updated_at' => date('Y-m-d H:i:s'),
             ]);

    	} else {
    		$update = DB::table('nguoidung')
                        ->where('id',$idUser)
                        ->update([
                            'hoten' => $ho_ten,
                            'gioitinh' => $gioi_tinh,
                            'anhdaidien' => $currentAvatar,
                            'diachi' => $dia_chi,
                            'so_dt' => $so_dt,
                            'so_cmnd' => $so_cmnd,
                            'updated_at' => date('Y-m-d H:i:s'),
             ]);

    	}

    	if($update){
            return back()->with('status-edituser', 'Cập nhật thông tin thành công');
        }else {
            return back()->with('failed-edituser', 'Cập nhật thông tin thất bại');
        }

    }

    public function changePw(){
    	$dataUser = $this->dbUser->getDataUser(session()->get('id'));

    	return view('mainsite.user.changePw')->with('data', $dataUser);  
    }
    public function changePwHandle(Request $request){
    	
    	Validator::make($request->all(), [
                // yeu cau cua cac input trong form
            'matkhau_cu' => 'required',
            'password' => 'required|confirmed|max:60',

    	],
    	[
                // noi dung thong bao ra view
           	'matkhau_cu.required' => 'Mật khẩu cũ không được bỏ trống',
           	'password.required' => 'Mật khẩu mới không được bỏ trống',
           	'password.confirmed' => 'Nhập lại mật khẩu chưa trùng khớp',
    	])->validate();

    	$idUser = session()->get('id');
    	$inputPw = $request->input('matkhau_cu');
    	$newPw = $request->input('password');

    	$checkPw = $this->dbUser->checkPassword($idUser, $inputPw);
    	$count = count($checkPw);

    	if ($count == 1) {
    		$update = DB::table('nguoidung')
                        ->where('id',$idUser)
                        ->update([
                            'matkhau' => $newPw,
                            'updated_at' => date('Y-m-d H:i:s'),
             ]);

    		return back()->with('status-changepw', 'Thay đổi mật khẩu thành công');
    	} else {
    		return back()->with('failed-changepw', 'Mật khẩu cũ không chính xác');
    	}
    }

    public function userProduct(){
    	$userID = session()->get('id');
    	$dataUser = $this->dbUser->getDataUser($userID);
    	
    	$dataProduct = $this->dbProduct->getProductbyUserID($userID);
    	// $dataProduct = json_decode(json_encode($dataProduct),true);

    	$data = [
    		'dataUser' => $dataUser,
    		'dataProduct' => $dataProduct,
    	];

    	// dd($data);

    	return view('mainsite.user.userProduct')->with('data', $data);
    }

    public function editProduct($id_sanpham){
    	
    	$userID = session()->get('id');
    	$dataUser = $this->dbUser->getDataUser($userID);
    	
    	$dataProduct = $this->dbProduct->getProductWithImagebyID($id_sanpham);
    	$dataProduct = json_decode(json_encode($dataProduct),true);

        $oldImage = DB::table('hinhanh')->where('id_sanpham', $id_sanpham)->get();

        // dd($oldImage);

    	$data = [
    		'dataUser' => $dataUser,
    		'dataProduct' => $dataProduct,
            'oldImage' => $oldImage,
    	];
    	// dd($data);
    	return view('mainsite.user.editProduct')->with('data', $data);
    }

    public function editProductHandle(Request $request, $id_sanpham){
    	// dd($request->all());

    	Validator::make($request->all(), [
    		// yeu cau cua cac input trong form
          'ten_sp' => 'required|max:99',
          'diachi_chitiet' => 'required',
          'anh_sp' => 'max:2000'
        ],
        [
		  // noi dung thong bao ra view
         'ten_sp.required' => 'Tiêu đề không được để trống',
         'diachi_chitiet.required' => 'Vui lòng nhập địa chỉ chi tiết',
         'anh_sp.max' => 'Ảnh vượt quá kích cỡ cho phép'
        ])->validate();

        $id_nguoidung = session()->get('id');
    	$ten_sp = $request->input('ten_sp');
    	$loai_hinh = $request->input('loai_hinh');
    	$loai_sp = $request->input('loai_sp');
    	$khu_vuc = $request->input('khu_vuc');
    	$tinh_thanh = $request->input('tinh_thanh');
        $quan_huyen = $request->input('quan_huyen');
    	$gia_tien = $request->input('gia_tien');
    	$dien_tich = $request->input('dien_tich');
    	$diachi_chitiet = $request->input('diachi_chitiet');
    	$mota_soluoc = $request->input('mota_soluoc');
    	$so_tang = $request->input('so_tang');
    	$so_phongan = $request->input('so_phongan');
    	$so_phongngu = $request->input('so_phongngu');
    	$so_nhavesinh = $request->input('so_nhavesinh');
    	$tinh_trang = $request->input('tinh_trang');
    	$anh_sp = $request->file('anh_sp');

    	if ($request->hasFile('anh_sp')) {

    		$allowedfileExtension=['pdf','jpg','png','docx'];
    		$files = $anh_sp;
    		
    		foreach($files as $file){
    			$fileName = $file->getClientOriginalName();
    			$extension = $file->getClientOriginalExtension();
    			$check=in_array($extension,$allowedfileExtension);
    			if ($check) {
    				$images[]=$fileName;
    				$file->move('upload/product',$fileName);
    			}
    		}
    		//save to DB

    		//Sua bang san pham
    		$query1 = DB::table('sanpham')->select('id_khuvuc')->where('id', $id_sanpham)->first();
            $khuvuc_OLD = $query1->id_khuvuc;
            $query2 = DB::table('sanpham')->select('id_tinhthanh')->where('id', $id_sanpham)->first();
            $tinhthanh_OLD = $query2->id_tinhthanh;
            $query3 = DB::table('sanpham')->select('id_quanhuyen')->where('id', $id_sanpham)->first();
            $quanhuyen_OLD = $query3->id_quanhuyen;
            
            if ($khu_vuc == "null" || $tinh_thanh == "null" || $quan_huyen == "null") {
                $updateSanPham = DB::table('sanpham')
                        ->where('id',$id_sanpham)
                        ->update([
                           'ten_sp' => $ten_sp,
                           'id_loaihinh' => $loai_hinh,
                           'id_loaisp' => $loai_sp,
                           'id_khuvuc' => $khuvuc_OLD,
                           'id_tinhthanh' => $tinhthanh_OLD,
                           'id_quanhuyen' => $quanhuyen_OLD,
                           'dien_tich' => $dien_tich,
                           'gia_tien' => $gia_tien,
                           'diachi_chitiet' => $diachi_chitiet,
                           'mota_soluoc' => $mota_soluoc,
                           'tinh_trang' => $tinh_trang,
                           'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else{
                $updateSanPham = DB::table('sanpham')
                        ->where('id',$id_sanpham)
                        ->update([
                           'ten_sp' => $ten_sp,
                           'id_loaihinh' => $loai_hinh,
                           'id_loaisp' => $loai_sp,
                           'id_khuvuc' => $khu_vuc,
                           'id_tinhthanh' => $tinh_thanh,
                           'id_quanhuyen' => $quan_huyen,
                           'dien_tich' => $dien_tich,
                           'gia_tien' => $gia_tien,
                           'diachi_chitiet' => $diachi_chitiet,
                           'mota_soluoc' => $mota_soluoc,
                           'tinh_trang' => $tinh_trang,
                           'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            //Lay ID vua insert vao bang san pham
            $removeCurrentImg = DB::table('hinhanh')->where('id_sanpham', '=', $id_sanpham)->delete();

            //Thay anh moi
            foreach ($images as $value) {

                $insertToHinhAnh = DB::table('hinhanh')->insertGetId([
                    'id_sanpham' => $id_sanpham,
                    'nguon_anh' => 'upload/product/'.$value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            //Cap nhat bang chi tiet sp
            //
            $updateChiTietSanPham = DB::table('chitietsanpham')
            			->where('id_sanpham',$id_sanpham)
                        ->update([
                        	'id_loaihinh' => $loai_hinh,
                        	'id_loaisp' => $loai_sp,
                        	'so_tang' => $so_tang,
                        	'so_phongan' => $so_phongan,
                        	'so_phongngu' => $so_phongngu,
                        	'so_nhavesinh' => $so_nhavesinh,
                        	'updated_at' => date('Y-m-d H:i:s')
            ]);

    	} else {
    		//Khong co hinh, chi update sanpham va chi tiet sanpham
    		$query1 = DB::table('sanpham')->select('id_khuvuc')->where('id', $id_sanpham)->first();
            $khuvuc_OLD = $query1->id_khuvuc;
            $query2 = DB::table('sanpham')->select('id_tinhthanh')->where('id', $id_sanpham)->first();
            $tinhthanh_OLD = $query2->id_tinhthanh;
            $query3 = DB::table('sanpham')->select('id_quanhuyen')->where('id', $id_sanpham)->first();
            $quanhuyen_OLD = $query3->id_quanhuyen;
            
            if ($khu_vuc == "null" || $tinh_thanh == "null" || $quan_huyen == "null") {
                $updateSanPham = DB::table('sanpham')
                                ->where('id',$id_sanpham)
                                ->update([
                                 'ten_sp' => $ten_sp,
                                 'id_loaihinh' => $loai_hinh,
                                 'id_loaisp' => $loai_sp,
                                 'id_khuvuc' => $khuvuc_OLD,
                                 'id_tinhthanh' => $tinhthanh_OLD,
                                 'id_quanhuyen' => $quanhuyen_OLD,
                                 'dien_tich' => $dien_tich,
                                 'gia_tien' => $gia_tien,
                                 'diachi_chitiet' => $diachi_chitiet,
                                 'mota_soluoc' => $mota_soluoc,
                                 'tinh_trang' => $tinh_trang,
                                 'updated_at' => date('Y-m-d H:i:s'),
             ]);
            } else{
                $updateSanPham = DB::table('sanpham')
                                ->where('id',$id_sanpham)
                                ->update([
                                 'ten_sp' => $ten_sp,
                                 'id_loaihinh' => $loai_hinh,
                                 'id_loaisp' => $loai_sp,
                                 'id_khuvuc' => $khu_vuc,
                                 'id_tinhthanh' => $tinh_thanh,
                                 'id_quanhuyen' => $quan_huyen,
                                 'dien_tich' => $dien_tich,
                                 'gia_tien' => $gia_tien,
                                 'diachi_chitiet' => $diachi_chitiet,
                                 'mota_soluoc' => $mota_soluoc,
                                 'tinh_trang' => $tinh_trang,
                                 'updated_at' => date('Y-m-d H:i:s'),
             ]);
            }

            $updateChiTietSanPham = DB::table('chitietsanpham')
            ->where('id_sanpham',$id_sanpham)
            ->update([
               'id_loaihinh' => $loai_hinh,
               'id_loaisp' => $loai_sp,
               'so_tang' => $so_tang,
               'so_phongan' => $so_phongan,
               'so_phongngu' => $so_phongngu,
               'so_nhavesinh' => $so_nhavesinh,
               'updated_at' => date('Y-m-d H:i:s')
           ]);
        }

    	if ($updateChiTietSanPham) {
                return back()->with('success-editProduct', 'Sửa bài đăng thành công !');
            } else {
                return back()->with('failed-editProduct', 'Sửa bài đăng bài thất bại !');
            }
	}

	public function mailIndex(){
		$cur_userID = session()->get('id');
		$cur_userName = session()->get('tentaikhoan');

    	$dataUser = $this->dbUser->getDataUser($cur_userID);

    	$dataMail = $this->dbMail->getMailbyUserID($cur_userID);
    	
    	$dataSent = $this->dbMail->getSentMail($cur_userName);

    	$data = [
    		'dataUser' => $dataUser,
    		'dataMail' => $dataMail,
    		'dataSent' => $dataSent
    	];
    	// dd($data);
		return view('mainsite.user.mail')->with('data', $data);
	}

	public function mailDetail($mail_id, $tieu_de){
		
		$cur_userID = session()->get('id');
		$dataUser = $this->dbUser->getDataUser($cur_userID);

		$mailDetail = $this->dbMail->getMailbyID($mail_id);

		$data = [
    		'dataUser' => $dataUser,
    		'mailDetail' => $mailDetail,
    	];

    	return view('mainsite.user.maildetail')->with('data', $data);
	}

	public function mailSend($mail_id = null){
		$cur_userID = session()->get('id');
		$dataUser = $this->dbUser->getDataUser($cur_userID);

		$mailDetail = $this->dbMail->getMailbyID($mail_id); //lay data mail do sau do lay nguoi gui
		
		$sender = null;

		foreach ($mailDetail as $value) {
			if ($mail_id != null) {
				$sender = [
					'nguoigui' => $value['nguoigui']
				];
			}
		}

		$data = [
    		'dataUser' => $dataUser, //lay avatar
    		'sender' => $sender, //sender chinh la nguoi da gui thu trc do cho minh
    	];
    	// dd($data);
		return view('mainsite.user.mailsend')->with('data', $data);
	}
    public function messSender($sanpham_id = null){
        $cur_userID = session()->get('id');
        $dataUser = $this->dbUser->getDataUser($cur_userID);

        $dataProduct = DB::table('sanpham')->where('id', $sanpham_id)->get();


        // dd($dataProduct);
        $receiver = null;
        foreach ($dataProduct as $val) {
            $receiver = DB::table('nguoidung')->select('tentaikhoan')->where('id',$val->id_nguoidung)->get();
        }

       
        $data = [
            'dataUser' => $dataUser, //lay avatar
            'dataProduct' => $dataProduct, //sender chinh la nguoi da gui thu trc do cho minh
            'dataReceiver' => $receiver,
        ];
        // dd($data);
        return view('mainsite.user.messagesend')->with('data', $data);
    }

	public function mailSendHandle($mail_id = null, Request $request){
		
		Validator::make($request->all(), [
                // yeu cau cua cac input trong form
			'nguoi_nhan' => 'required|max:60',
			'tieu_de' => 'required|max:120',
			'noi_dung' => 'required',

		],
		[
                // noi dung thong bao ra view
			'nguoi_nhan.required' => 'Người gửi không được bỏ trống',
			'tieu_de.required' => 'Tiêu đề không được bỏ trống',
			'noi_dung.required' => 'Nội dung không được bỏ trống',
			'nguoi_nhan.max' => 'Tên người gửi không hợp lệ',
			'tieu_de.max' => 'Tiêu đề không được vượt quá 120 ký tự',
		])->validate();

		$nguoi_gui = session()->get('tentaikhoan');
		$nguoi_nhan = $this->dbUser->getIDbyAccName($request->input('nguoi_nhan'));
		$tieu_de = $request->input('tieu_de');
		$noi_dung = $request->input('noi_dung');
		
        $idNguoiNhan = null;

		foreach ($nguoi_nhan as $value) {
			if ($value['id'] != 0) {
				$idNguoiNhan = $value['id'];
			}
		}

		if ($idNguoiNhan != null) {
			$insert = DB::table('homthu')->insertGetId([
                'id_nguoidung' => $idNguoiNhan,
                'nguoigui' => $nguoi_gui,
                'tieu_de' => $tieu_de,
                'noi_dung' => $noi_dung,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
       		]);

       		return back()->with('status-sendmail', 'Đã gửi thư !');

		} else {
			return back()->with('failed-sendmail', 'Tài khoản ngưởi nhận không tồn tại !');
		}
		


	}
    public static function messSenderHandle(Request $request, $sanpham_id = null){

        Validator::make($request->all(), [
                // yeu cau cua cac input trong form
            'nguoi_nhan' => 'required|max:60',
            'tieu_de' => 'required|max:120',
            'noi_dung' => 'required',

        ],
        [
                // noi dung thong bao ra view
            'nguoi_nhan.required' => 'Người gửi không được bỏ trống',
            'tieu_de.required' => 'Tiêu đề không được bỏ trống',
            'noi_dung.required' => 'Nội dung không được bỏ trống',
            'nguoi_nhan.max' => 'Tên người gửi không hợp lệ',
            'tieu_de.max' => 'Tiêu đề không được vượt quá 120 ký tự',
        ])->validate();


        $nguoi_gui = session()->get('tentaikhoan');
        $nguoi_nhan = DB::table('nguoidung')->where('tentaikhoan', $request->input('nguoi_nhan'))->get();
        $tieu_de = $request->input('tieu_de');
        $noi_dung = $request->input('noi_dung');
       
        // dd($nguoi_nhan);
        $idNguoiNhan = null;

        foreach ($nguoi_nhan as $value) {
            if ($value->id != 0) {
                $idNguoiNhan = $value->id;
            }
        }

        if ($idNguoiNhan != null) {
            $insert = DB::table('homthu')->insertGetId([
                'id_nguoidung' => $idNguoiNhan,
                'nguoigui' => $nguoi_gui,
                'tieu_de' => $tieu_de,
                'noi_dung' => $noi_dung,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ]);

            return back()->with('status-sendmess', 'Đã gửi tin !');

        } else {
            return back()->with('failed-sendmess', 'Tài khoản ngưởi nhận không tồn tại !');
        }

    }

	public function mailDelete($mail_id)
	{
		$update = DB::table('homthu')
                        ->where('id', $mail_id)
                        ->update([
                            'is_deleted' => 1,
        ]);

        return back();
	}

}