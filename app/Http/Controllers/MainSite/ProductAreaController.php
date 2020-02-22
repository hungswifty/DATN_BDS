<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductAreaController extends Controller
{
	private $dbProduct;
	public function __construct(Product $product){
		$this->dbProduct = $product;
	}
    public function selling(){
    	// 1 mean id_loai = ban'
    	$data = $this->dbProduct->getAllofTypeProduct(1);

    	// dd($data);

    	return view('mainsite.product.selling')->with('data', $data);
    }
    public function renting(){
    	// 2 mean id_loai = cho thue
    	$data = $this->dbProduct->getAllofTypeProduct(2);

    	// dd($data);

    	return view('mainsite.product.renting')->with('data', $data);
    }
    public function searching(Request $request){
    	
        // dd($request->all());
    	//  ?? 'is null'
    	$id_loaihinh = $request->input('loai_hinh'); 
    	$id_loaisp = $request->input('loai_sp');
        $khu_vuc = $request->input('khu_vuc');
    	$tinh_thanh = $request->input('tinh_thanh');
        $quan_huyen = $request->input('quan_huyen');
    	$gia_tien = $request->input('gia_tien');
    	$dien_tich = $request->input('dien_tich');

    	$data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('quanhuyen', 'quanhuyen.id', '=', 'sanpham.id_quanhuyen')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, sanpham.id_tinhthanh, id_quanhuyen, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, ten_tinhthanh, ten_quanhuyen, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('tinh_trang',0)
                     ->where('trang_thai',1)
                     // when cung gan giong if, khi nao bien co gia tri nhu yeu cau thi moi t.hien query
                     ->when($id_loaihinh, function ($query, $id_loaihinh) {
                    		return $query->whereRaw("sanpham.id_loaihinh $id_loaihinh");
                		})
                     ->when($id_loaisp, function ($query, $id_loaisp) {
                    		return $query->whereRaw("sanpham.id_loaisp $id_loaisp");
                		})
                     ->when($khu_vuc, function ($query, $khu_vuc) {
                            return $query->whereRaw("sanpham.id_khuvuc = $khu_vuc");
                        })
                     ->when($tinh_thanh, function ($query, $tinh_thanh) {
                    		return $query->whereRaw("sanpham.id_tinhthanh = $tinh_thanh");
                		})
                     ->when($quan_huyen, function ($query, $quan_huyen) {
                            return $query->whereRaw("id_quanhuyen = $quan_huyen");
                        })
                     ->when($gia_tien, function ($query, $gia_tien) {
                    		return $query->whereRaw("gia_tien $gia_tien");
                		})
                     ->when($dien_tich, function ($query, $dien_tich) {
                    		return $query->whereRaw("dien_tich $dien_tich");
                		})
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->orderBy('is_vip','desc')
                     ->paginate(9);
        // dd($data->count());
        // foreach ($data as $value) {
        //     $totalPage = $data->total();
        // }

        if ($data->count() != 0) {
            return view('mainsite.search.index')->with('data', $data);
        } else {
            return back()->with('search-failed','Thông tin tìm kiếm hiện không có !');
        }
    	
    }
}
