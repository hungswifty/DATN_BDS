<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'sanpham';
    use SoftDeletes;

    public function user(){
    	return $this->hasOne('App\Model\Users');
    }
    //khu vuc
    public function area(){
    	return $this->hasOne('App\Model\Area');
    }
    //tinh
    public function province(){
    	return $this->hasOne('App\Model\Province');
    }
    //loai hinh : ban/cho thue
    public function productType(){
    	return $this->hasOne('App\Model\ProductType');
    }
    //loai san pham
    public function productCategory(){
    	return $this->hasOne('App\Model\ProductCategory');
    }
    public function productDetail(){
    	return $this->hasOne('App\Model\ProductDetail');
    }

    public function image(){
    	return $this->hasMany('App\Model\Images');
    }

    public function report(){
        return $this->hasMany('App\Model\Report');
    }

    public function exchangeDataArray($data){
    	//viet ham de chuyen object ve mang 
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }

    public function getAllDataProduct()
    {
    	$data = Product::all();
    	$data = ($data) ? $data->toArray() : [];
    	return $data;
    }

    public function getAllDataProductWithPagination()
    {
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=','sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=','sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=','sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=','sanpham.id_loaisp')
                    ->join('nguoidung', 'nguoidung.id', '=','sanpham.id_nguoidung')
                     ->select(DB::raw('sanpham.id, ten_sp, id_loaihinh, id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, tentaikhoan, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, sanpham.created_at, sanpham.updated_at'))
                     ->whereNull('sanpham.deleted_at')
                     ->groupBy('id_sanpham')
                     ->paginate(10);

        
        return $data;
    }

    public function getAllDataProductforAdmin()
    {
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('tinhthanh', 'tinhthanh.id', '=','sanpham.id_tinhthanh')
                    ->join('quanhuyen', 'quanhuyen.id', '=', 'sanpham.id_quanhuyen')
                    ->join('loaihinh', 'loaihinh.id', '=','sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=','sanpham.id_loaisp')
                    ->join('nguoidung', 'nguoidung.id', '=','sanpham.id_nguoidung')
                    ->select(DB::raw('sanpham.id, ten_sp, id_loaihinh, id_loaisp, sanpham.id_khuvuc, sanpham.id_tinhthanh, id_quanhuyen,id_nguoidung, tentaikhoan, dien_tich, gia_tien, diachi_chitiet, is_vip, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, ten_tinhthanh, ten_quanhuyen,ten_loaihinh, loai_sp, nguon_anh, sanpham.created_at, sanpham.updated_at'))
                    ->whereNull('sanpham.deleted_at')
                    ->groupBy('id_sanpham')
                    ->get();

        
        return $data;
    }


    //cho trang chu, chi hien 6 bai 1 muc
    public static function getProductbyLoaiHinhMax6($id_loaihinh)
    {
        $data = Product::where('id_loaihinh', $id_loaihinh)
				        ->where('tinh_trang',0)
				        ->where('trang_thai',1)
				        ->paginate(6);
        $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }

    //cho trang xem tat ca cua 1 the loai
    public static function getProductbyID_loaihinh($id_loaihinh)
    {
        $data = Product::where('id_loaihinh', $id_loaihinh)->get();
        $data = ($data) ? $data->toArray() : [] ; //ket qua tra ve theo  kieu object nen phai chuyen ve mang de tien lam viec
        return $data;
    }

    //Lay hinh anh nhung chia data theo loai hinh
    public function getProductWithImage($id_loaihinh){
    	$data = DB::table('sanpham')
    				->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
    				->join('tinhthanh', 'tinhthanh.id', '=','sanpham.id_tinhthanh')
    				->join('khuvuc', 'khuvuc.id', '=','sanpham.id_khuvuc')
    				->join('loaihinh', 'loaihinh.id', '=','sanpham.id_loaihinh')
    				->join('loaisanpham', 'loaisanpham.id', '=','sanpham.id_loaisp')
                    ->join('quanhuyen','quanhuyen.id', '=', 'sanpham.id_quanhuyen')
                     ->select(DB::raw('sanpham.id, ten_sp, id_loaihinh, id_loaisp, sanpham.id_khuvuc, sanpham.id_tinhthanh, id_quanhuyen, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, ten_tinhthanh, ten_quanhuyen, ten_loaihinh, loai_sp, nguon_anh, is_vip, sanpham.created_at, sanpham.updated_at'))
                     ->where('id_loaihinh', $id_loaihinh)
                     ->where('tinh_trang',0)
				     ->where('trang_thai',1)
                     ->groupBy('id_sanpham')
                     ->orderBy('is_vip','desc')
                     ->take(6)
                     ->get(); //ket qua tra ve la doi tuong nen phai doi ra array
        
        return $this->exchangeDataArray($data);
    }

    //Lay bai viet vip
    public function getVIPproduct(){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=','sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=','sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=','sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=','sanpham.id_loaisp')
                     ->select(DB::raw('sanpham.id, ten_sp, id_loaihinh, id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, is_vip, sanpham.created_at, sanpham.updated_at'))
                     ->where('tinh_trang', 0)
                     ->where('trang_thai', 1)
                     ->where('is_vip', 1)
                     ->groupBy('id_sanpham')
                     ->orderBy('updated_at','desc')
                     ->take(6)
                     ->get(); //ket qua tra ve la doi tuong nen phai doi ra array
        
        return $this->exchangeDataArray($data);
    }

    //Lay hinh anh va cac thong tin chi tiet cua 1 san pham qua id user
    public function getProductbyUserID($id_user){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('quanhuyen', 'quanhuyen.id', '=', 'sanpham.id_quanhuyen')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, sanpham.id_tinhthanh, id_quanhuyen, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_quanhuyen, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('id_nguoidung', $id_user)
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->paginate(5);
        
        return $data;
    }

    //Lay hinh anh va cac thong tin chi tiet cua 1 san pham
    public function getProductWithImagebyID($id_sanpham){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                    ->join('quanhuyen', 'quanhuyen.id', '=', 'sanpham.id_quanhuyen')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, sanpham.id_tinhthanh, id_quanhuyen, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_quanhuyen, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('sanpham.id', $id_sanpham)
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->get();
        
        return $this->exchangeDataArray($data);
    }

    public function getProductDetailforAdmin($id_sanpham){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                    ->join('nguoidung', 'nguoidung.id', '=', 'sanpham.id_nguoidung')
                     ->select(DB::raw('sanpham.id, ten_sp, tentaikhoan, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, is_vip,ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('sanpham.id', $id_sanpham)
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->get();
        
        return $this->exchangeDataArray($data);
    }

    //Lay thong tin chi tiet san pham theo tinh thanh
    public function getProductbyProvinceID($id_tinhthanh){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('tinhthanh.id', $id_tinhthanh)
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->get();
        
        return $this->exchangeDataArray($data);
    }

    // Lay tat ca anh thuoc 1 id
    public function getAllImagebyProductID($id_sanpham){
        $data = DB::table('hinhanh')
                    ->select(DB::raw('id_sanpham, nguon_anh'))
                    ->where('id_sanpham', $id_sanpham)
                    ->get();

        return $this->exchangeDataArray($data);
    }

    public function getAllofTypeProduct($id_loaihinh){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('sanpham.id_loaihinh', $id_loaihinh)
                     ->where('tinh_trang',0)
                     ->where('trang_thai',1)
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->orderBy('created_at','desc')
                     ->paginate(9);
                     // phan trang
        
        return $data;
    }

    public function getAllofTypeProductbyFilter($id_loaihinh, $id_loaisp, $id_tinhthanh, $gia_tien, $dien_tich){
        $data = DB::table('sanpham')
                    ->join('hinhanh', 'hinhanh.id_sanpham', '=', 'sanpham.id')
                    ->join('tinhthanh', 'tinhthanh.id', '=', 'sanpham.id_tinhthanh')
                    ->join('khuvuc', 'khuvuc.id', '=', 'sanpham.id_khuvuc')
                    ->join('loaihinh', 'loaihinh.id', '=', 'sanpham.id_loaihinh')
                    ->join('loaisanpham', 'loaisanpham.id', '=', 'sanpham.id_loaisp')
                    ->join('chitietsanpham', 'chitietsanpham.id_sanpham', '=', 'sanpham.id')
                     ->select(DB::raw('sanpham.id, ten_sp, sanpham.id_loaihinh, sanpham.id_loaisp, sanpham.id_khuvuc, id_tinhthanh, id_nguoidung, dien_tich, gia_tien, diachi_chitiet, mota_soluoc, tinh_trang, trang_thai, ten_khuvuc, tinhthanh.id as id_tinhthanh,ten_tinhthanh, ten_loaihinh, loai_sp, nguon_anh, so_tang, so_phongan, so_phongngu, so_nhavesinh, sanpham.created_at, sanpham.updated_at'))
                     ->where('tinh_trang',0)
                     ->where('trang_thai',1)
                     ->whereRaw("sanpham.id_loaihinh $id_loaihinh")
                     ->whereRaw("sanpham.id_loaisp $id_loaisp")
                     ->whereRaw("gia_tien $gia_tien")
                     ->whereRaw("id_tinhthanh $id_tinhthanh")
                     ->whereRaw("dien_tich $dien_tich")
                     ->groupBy('chitietsanpham.id_sanpham')
                     ->orderBy('created_at','desc')
                     ->get();
                     // phan trang
        
        return $data;
    }


}
