<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Model\Images;
use Validator;

class ImageController extends Controller
{
	private $dbImage;

	public function __construct(Images $image){
		$this->dbImage = $image;
	}
    public function addImageIndex()
    {
    	$idAvailable = DB::table('sanpham')->select('id','ten_sp')->get();
    	// dd($idAvailable);
    	return view('admin.image.addimage')->with('idAvailable', $idAvailable);
    }

    public function addImageHandle(Request $request)
    {
    	// dd($request->all());

    	Validator::make($request->all(), [
    		// yeu cau cua cac input trong form
          'anh_sp' => 'max:2000'
        ],
        [
		  // noi dung thong bao ra view
         'anh_sp.max' => 'Ảnh vượt quá kích cỡ cho phép'
        ])->validate();

    	$id_sp = $request->input('id_sanpham');
    	$anh_sp = $request->file('anh_sp');
    	$getImageSourcebyID = DB::table('hinhanh')->select('nguon_anh')->where('id_sanpham','=', $id_sp)->get();
    	$checkIfExisted = [];

    	foreach ($getImageSourcebyID as $img) {
    		$explode = explode('/', $img->nguon_anh)[2];
    		$checkIfExisted[] = $explode;
    	}

    	
    	 // dd($checkIfExisted);

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

    		foreach ($images as $value) {

    			$checkExisted = in_array($value, $checkIfExisted);
    			
    			if (!$checkExisted) {
    				$insertToHinhAnh = DB::table('hinhanh')->insertGetId([
                    'id_sanpham' => $id_sp,
                    'nguon_anh' => 'upload/product/'.$value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
               		]);
    			}

            }

            if ($insertToHinhAnh) {
                return back()->with('ADsuccess-addImage', 'Thêm mới thành công !');
            } else {
                return back()->with('ADfailed-addImage', 'Thêm mới thất bại !');
            }
            

    	}

    }

    public function displayAllImage(){
    	return view('admin.image.displayall');
    }

    public function editImageDetail($image_id){
    	$data = $this->dbImage->getImageDetail($image_id);
    	// dd($data);
    	return view('admin.image.editimage')->with('data', $data);
    }
    public function dataForDisplayAllImage(){
        $data = $this->dbImage->getAllDataImageforAdmin();

        return Datatables::of($data)
                            ->addColumn('edit', function ($data) {
                                    return  '<a href="' . route('admin.edit-image-details', $data->id) .'">'.'<button type="button" class="btn btn-outline-info" title="Sửa" >Sửa</button></a>';
                            })
                            ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-image', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa bài đăng có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
                            ->addColumn('hinh_anh', function($data){
                                    return '<img src="../' .$data->nguon_anh.'"' .'alt="Ảnh" width="150" height="150">';
                            })
                            ->rawColumns(['edit' => 'edit','delete' => 'delete','hinh_anh' => 'hinh_anh'])

                            ->make(true);
    }

    public function editImageHandle(Request $request){
    	// dd($request->all());

    	Validator::make($request->all(), [
                // yeu cau cua cac input trong form
                'anh_new' => 'mimes:jpeg,png,bmp,tiff |max:2048',

            ],
            [
                // noi dung thong bao ra view
                'anh_new.mimes' => 'Yêu cầu chọn đúng định dạng file ảnh JPG, JPEG, PNG, BMP',
            ])->validate();

    	$id_hinhanh = $request->input('id_hinhanh');

            
        if ($request->hasFile('anh_new')) {
            $file = $request->file('anh_new');
            // Lay ten + duoi file
            $fileName = $file->getClientOriginalName();
            // Luu vao upload
            $file->move('upload/product', $fileName);
            // echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            // 
            // Luu vao csdl
            $update = DB::table('hinhanh')
                        ->where('id', $id_hinhanh)
                        ->update([
                            'nguon_anh' => 'upload/product/'.$fileName,
                            'updated_at' => date('Y-m-d H:i:s'),
                                ]);
            
        } else {
            //Keep old picture if no file is selected
            $getCurrentFileName = DB::table('hinhanh')->select('nguon_anh')->where('id','=', $id_hinhanh)->get();
            $fileNameCurrent = '';
            
            foreach ($getCurrentFileName as $value) {
            	$fileNameCurrent = $value->nguon_anh;
            }

            // Luu vao csdl
            $update = DB::table('hinhanh')
                        ->where('id',$id_hinhanh)
                        ->update([
                            'nguon_anh' => $fileNameCurrent,
                            'updated_at' => date('Y-m-d H:i:s'),
                                ]);
        }


        if($update){
            return back()->with('ADsuccess-editImage', 'Sửa thành công');
        }else {
            return back()->with('ADfailed-editImage', 'Sửa thất bại');
        }

    }

    public function deleteImage($image_id)
    {
    	$imageDetail = $this->dbImage->find($image_id);

    	// dd($imageDetail);
        $imageDel = $imageDetail->delete();
        
        if ($imageDel) {
            return back()->with('ADsuccess-delImage', 'Xóa thành công');
        }else {
            return back()->with('ADfailed-delImage', 'Xóa thất bại');
        }
    }

    public function restoreImage()
    {
    	$imageDetail = $this->dbImage->withTrashed();
        $imageRestore = $imageDetail->restore();
        if ($imageRestore) {
            return back();
        }
    }
}
