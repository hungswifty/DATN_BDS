<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Model\Product;

class UploadProductController extends Controller
{
    public function index(){
        $data = DB::table('khuvuc')->select('id','ten_khuvuc')->get();

    	return view('mainsite.upload-pd.index')->with('data',$data);
    }
    public function handleUpload(Request $request){
    	// test du lieu gui len
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


    	// 
    	// dd($request->all());
    	
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

    		$insertToSanPham = DB::table('sanpham')->insertGetId([
    				'ten_sp' => $ten_sp,
    				'id_loaihinh' => $loai_hinh,
    				'id_loaisp' => $loai_sp,
    				'id_khuvuc' => $khu_vuc,
    				'id_tinhthanh' => $tinh_thanh,
                    'id_quanhuyen' => $quan_huyen,
    				'id_nguoidung' => $id_nguoidung,
    				'dien_tich' => $dien_tich,
    				'gia_tien' => $gia_tien,
    				'diachi_chitiet' => $diachi_chitiet,
    				'mota_soluoc' => $mota_soluoc,
    				'created_at' => date('Y-m-d H:i:s'),
    				'updated_at' => null
    			]);
            //Lay ID vua insert vao bang san pham
            $getLatestId = Product::latest()->first();

            foreach ($images as $value) {

                $insertToHinhAnh = DB::table('hinhanh')->insertGetId([
                    'id_sanpham' => $getLatestId['id'],
                    'nguon_anh' => 'upload/product/'.$value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);
            }
            // Can upload them vao bang chitiet san pham
            $insertToChiTietSP = DB::table('chitietsanpham')->insertGetId([
                    'id_loaihinh' => $loai_hinh,
                    'id_loaisp' => $loai_sp,
                    'id_sanpham' => $getLatestId['id'],
                    'so_tang' => $so_tang,
                    'so_phongan' => $so_phongan,
                    'so_phongngu' => $so_phongngu,
                    'so_nhavesinh' => $so_nhavesinh,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

    	} else {
            // if has no file
            $insertToSanPham = DB::table('sanpham')->insertGetId([
                    'ten_sp' => $ten_sp,
                    'id_loaihinh' => $loai_hinh,
                    'id_loaisp' => $loai_sp,
                    'id_khuvuc' => $khu_vuc,
                    'id_tinhthanh' => $tinh_thanh,
                    'id_quanhuyen' => $quan_huyen,
                    'id_nguoidung' => $id_nguoidung,
                    'dien_tich' => $dien_tich,
                    'gia_tien' => $gia_tien,
                    'diachi_chitiet' => $diachi_chitiet,
                    'mota_soluoc' => $mota_soluoc,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

            $getLatestId = Product::latest()->first();

            //still upload to hinhanh table , but wil null
            $insertToHinhAnh = DB::table('hinhanh')->insertGetId([
                    'id_sanpham' => $getLatestId['id'],
                    'nguon_anh' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

            $insertToChiTietSP = DB::table('chitietsanpham')->insertGetId([
                    'id_loaihinh' => $loai_hinh,
                    'id_loaisp' => $loai_sp,
                    'id_sanpham' => $getLatestId['id'],
                    'so_tang' => $so_tang,
                    'so_phongan' => $so_phongan,
                    'so_phongngu' => $so_phongngu,
                    'so_nhavesinh' => $so_nhavesinh,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);
    		
    		
    	}
    
        if ($insertToChiTietSP) {
                return back()->with('success-upload', 'Đăng bài thành công !');
            } else {
                return back()->with('failed-upload', 'Đăng bài thất bại !');
            }

    }


}
