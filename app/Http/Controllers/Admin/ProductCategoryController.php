<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProductCategory;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Validator;


class ProductCategoryController extends Controller
{
	private $dbProductCate;

	public function __construct(ProductCategory $productCate){
		$this->dbProductCate = $productCate;
	}

    public function addProductCateIndex(){
    	return view('admin.product_category.addproductcate');
    }

    public function addProductCateHandle(Request $request){
    	// dd($request->all());
    	Validator::make($request->all(), [
    		// yeu cau cua cac input trong form
          'loai_sp' => 'required|max:99',
        ],
        [
		  // noi dung thong bao ra view
         'loai_sp.required' => 'Tên loại sản phẩm không được để trống',
         'loai_sp.max' => 'Tên loại sản phẩm không được vượt quá 99 ký tự!'
        ])->validate();

    	$loai_sp = $request->input('loai_sp');

    	if ($loai_sp != null) {
    		$insertToLoaiSP = DB::table('loaisanpham')->insertGetId([
    				'loai_sp' => $loai_sp,
    				'created_at' => date('Y-m-d H:i:s'),
    				'updated_at' => null
    		]);
    	}

    	if ($insertToLoaiSP) {
                return back()->with('ADsuccess-addProCate', 'Thêm mới thành công !');
        } else {
                return back()->with('ADfailed-addProCate', 'Thêm mới thất bại !');
        }

    }

    public function displayAllProCate(){
    	return view('admin.product_category.displayall');
    }
    public function dataForDisplayAllProCate(){
    	$data = DB::table('loaisanpham')->whereNull('deleted_at')->get();

    	return Datatables::of($data)
    						->addColumn('edit', function ($data) {
                                    return  '<a href="' . route('admin.edit-productcate-details', $data->id) .'">'.'<button type="button" class="btn btn-outline-info" title="Sửa" >Sửa</button></a>';
                            })
                            ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-productcate', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa tin đăng có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
                            ->rawColumns(['edit' => 'edit','delete' => 'delete'])

    						->make(true);
    }

    public function editProCateDetail($proCate_id){
    	$data = DB::table('loaisanpham')->where('id', $proCate_id)->get();
    	return view('admin.product_category.editproductcate')->with('data', $data);
    }

    public function editProCateHandle(Request $request){
    	Validator::make($request->all(), [
    		// yeu cau cua cac input trong form
          'loai_sp' => 'required|max:99',
        ],
        [
		  // noi dung thong bao ra view
         'loai_sp.required' => 'Tên loại sản phẩm không được để trống',
         'loai_sp.max' => 'Tên loại sản phẩm không được vượt quá 99 ký tự!'
        ])->validate();

    	// dd($request->all());

    	$id_loaisp = $request->input('id_loaisp');
    	$loai_sp = $request->input('loai_sp');

    	$updateProCate = DB::table('loaisanpham')
                        ->where('id',$id_loaisp)
                        ->update([
                           'loai_sp' => $loai_sp,
                           'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($updateProCate) {
                return back()->with('ADsuccess-editProCate', 'Sửa đổi thành công !');
        } else {
                return back()->with('ADfailed-editProCate', 'Sửa đổi thất bại !');
        }

    }

    public function deleteProCate($proCate_id){
    	
    	$proCateDetail = $this->dbProductCate->find($proCate_id);

    	// dd($productDetail);
        $proCateDel = $proCateDetail->delete();
        
        if ($proCateDel) {
            return back()->with('ADsuccess-delProCate', 'Xóa thành công');
        }else {
            return back()->with('ADfailed-delProCate', 'Xóa thất bại');
        }
    }

    public function restoreProCate(){
    	$proCateDetail = $this->dbProductCate->withTrashed();
        $proCateRestore = $proCateDetail->restore();
        if ($proCateRestore) {
            return back();
        }
    }
}
