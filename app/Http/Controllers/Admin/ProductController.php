<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
	private $dbProduct;	

	public function __construct(Product $product){
		$this->dbProduct = $product;
	}
    public function addProductIndex()
    {
        $dataLoaiSP = DB::table('loaisanpham')->select('id','loai_sp')->whereNull('deleted_at')->get();
        $dataKhuVuc = DB::table('khuvuc')->select('id','ten_khuvuc')->get();
        $data = [
            'dataLoaiSP' => $dataLoaiSP,
            'dataKhuVuc' => $dataKhuVuc,
        ];

        // dd($data);
    	return view('admin.product.addproduct')->with('data', $data);
    }
    public function addProductHandle(Request $request)
    {
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

    	$id_nguoidung = 4;
    	$ten_sp = $request->input('ten_sp');
    	$tinh_trang = $request->input('tinh_trang');
    	$trang_thai = $request->input('trang_thai');
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
    				'tinh_trang' => $tinh_trang,
    				'trang_thai' => $trang_thai,
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
                    'so_nhavesinh' => $so_nhavesinh
                ]);

    	} else {
            // if has no img, still upload to DB
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
                    'tinh_trang' => $tinh_trang,
    				'trang_thai' => $trang_thai,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
                ]);

            $getLatestId = Product::latest()->first();

            // but the image table has null value for nguon_anh
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
                    'so_nhavesinh' => $so_nhavesinh
                ]);
    		
    		
    	}
    
        if ($insertToChiTietSP) {
                return back()->with('ADsuccess-addproduct', 'Thêm mới thành công !');
        } else {
                return back()->with('ADfailed-addproduct', 'Thêm mới thất bại !');
        }

    }


    public function displayAllProduct(){

    	return view('admin.product.displayall');
    }

    public function dataForDisplayAllProduct(){

        $data = $this->dbProduct->getAllDataProductforAdmin();
        // dd($data2);
        return Datatables::of($data)
                            ->addColumn('edit', function ($data) {
                                    return  '<a href="' . route('admin.edit-product-details', $data->id) .'">'.'<button type="button" class="btn btn-outline-info" title="Sửa" >Sửa</button></a>';
                            })
                            ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-product', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa tin đăng có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
                            ->editColumn('tinh_trang', function ($data) {
                                if ($data->tinh_trang == 0) return 'Hiển thị';
                                if ($data->tinh_trang == 1) return 'Ẩn';
                            })
                            ->editColumn('trang_thai', function ($data) {
                                if ($data->trang_thai == 1) return 'Đã duyệt';
                                if ($data->trang_thai == 0) return 'Chưa duyệt';
                            })
                            ->editColumn('is_vip', function ($data) {
                                if ($data->is_vip == 0) return 'Không';
                                if ($data->is_vip == 1) return 'Có';
                            })
                            ->rawColumns(['edit' => 'edit','delete' => 'delete'])

                            ->make(true);
    }

    public function editProductDetail($product_id){
    	$productDetail = $this->dbProduct->getProductDetailforAdmin($product_id);


    	$loaisp = DB::table('loaisanpham')->whereNull('deleted_at')->get();

        $ImageOfSelectedProduct = DB::table('hinhanh')->where('id_sanpham', $product_id)->get();

        // dd($ImageOfSelectedProduct);

    	$data = [
    		'productDetail'=> $productDetail,
			'loaisp'=> $loaisp,
            'oldImage' => $ImageOfSelectedProduct,
    	];
        // dd($data);

    	// foreach ($data['loaisp'] as $key => $value){
    	// 	echo $value->id.' '.$value->loai_sp;
    	// }
    	// dd($data['loaisp']);

    	return view('admin.product.editproduct')->with('data', $data);

    }

    public function editProductHandle(Request $request){
    	
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

        // dd($request->all());

    	$id_sanpham = $request->input('id_sanpham');
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
    	$trang_thai = $request->input('trang_thai');
        $is_vip = $request->input('is_vip');
    	$anh_sp = $request->file('anh_sp');

        // dd($trang_thai);
    	if ($request->hasFile('anh_sp')) {

    		$allowedfileExtension=['pdf','jpg','png','docx'];
    		$files = $anh_sp;
    		
    		foreach($files as $file){
    			$fileName = $file->getClientOriginalName();
    			$extension = $file->getClientOriginalExtension();
    			$check = in_array($extension,$allowedfileExtension);
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
                           'trang_thai' => $trang_thai,
                           'is_vip' => $is_vip,
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
                           'trang_thai' => $trang_thai,
                           'is_vip' => $is_vip,
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
                           'trang_thai' => $trang_thai,
                           'is_vip' => $is_vip,
                           'updated_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
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
                           'trang_thai' => $trang_thai,
                           'is_vip' => $is_vip,
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
                return back()->with('ADsuccess-editproduct', 'Sửa bài đăng thành công !');
            } else {
                return back()->with('ADfailed-editproduct', 'Sửa bài đăng bài thất bại !');
            }
    }

    public function deleteProduct($product_id){
    	
    	$productDetail = $this->dbProduct->find($product_id);

    	// dd($productDetail);
        $productDel = $productDetail->delete();
        
        if ($productDel) {
            return back()->with('ADsuccess-delproduct', 'Xóa thành công');
        }else {
            return back()->with('ADfailed-delproduct', 'Xóa thất bại');
        }
    }

    public function restoreProduct(){
    	$productDetail = $this->dbProduct->withTrashed();
        $productRestore = $productDetail->restore();
        if ($productRestore) {
            return back();
        }
    }
}
