<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Model\News;


class PostArticlesController extends Controller
{
    private $dbNews;

    public function __construct(News $news){
        $this->dbNews = $news;
    }

    public function addPostIndex(){
    	return view('admin.post_articles.addpost');
    }
    
    public function addPostHandle(Request $request){
    	Validator::make($request->all(), [
    			// yeu cau cua cac input trong form
          'tieu_de' => 'required|max:300',
          'anh_dd' => 'required|mimes:jpeg,png,bmp,tiff |max:4096',

        ],
        [
		    	// noi dung thong bao ra view
         'tieu_de.required' => 'Tiêu đề không được để trống',
         'tieu_de.max' => 'Tiêu đề không được quá 300 kí tự',
         'anh_dd.required' => 'Vui lòng chọn ảnh đại diện cho bài viết',
         'anh_dd.mimes' => 'Yêu cầu chọn đúng định dạng file ảnh JPG, JPEG, PNG, BMP',
        ])->validate();


    	if ($request->hasFile('anh_dd')) {

    		// dd($request->all());

    		$file = $request->file('anh_dd');

    		// Lay ten + duoi file
    		$fileName = $file->getClientOriginalName();

    		// Luu vao upload
    		$file->move('upload', $fileName);
            // echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            // echo '<br/>';

            //Lấy đường dẫn tạm thời của file
            // echo 'Đường dẫn tạm: ' . $file->getRealPath();
            // echo '<br/>';

            //Lấy kích cỡ của file đơn vị tính theo bytes
            // echo 'Kích cỡ file: ' . $file->getSize();
            // echo '<br/>';

            //Lấy kiểu file
            // echo 'Kiểu files: ' . $file->getMimeType();
            // Luu vao csdl
            $insert = DB::table('baiviet')->insertGetId([
                'tieu_de' => $request->input('tieu_de'),
                'noi_dung' => $request->input('noi_dung'),
                'anh_dd' => 'upload/'.$fileName,
                'id_dm' => $request->input('the_loai'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ]);

    	}

    	if($insert){
            return back()->with('status-addnews', 'Thêm mới thành công');
        }else {
            return back()->with('failed-addnews', 'Thêm mới thất bại');
        }

    }

    public function editPostIndex(){
        return view('admin.post_articles.index');
    }

    public function getDataforDisplayAll(){
        $data = $this->dbNews->getAllDataNews();

        return Datatables::of($data)
                            ->addColumn('edit', function ($data) {
                                    return  '<a href="' . route('admin.edit-post-details', $data->id) .'">'.'<button type="button" class="btn btn-outline-info" title="Sửa" >Sửa</button></a>';
                                })
                            ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-post', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa bài đăng có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
                            ->editColumn('noi_dung', function ($data) {
                                return str_limit($data->noi_dung,50);
                            })
                            ->editColumn('anh_dd', function ($data) {
                                return '<img src="../'.$data->anh_dd.'"'.' class="news-anhdd">';
                            })
                            ->editColumn('id_dm', function ($data) {
                                if ($data->id_dm == 1) return 'Tin trong nuớc';
                                if ($data->id_dm == 2) return 'Tin nước ngoài';
                            })
                            ->rawColumns(['edit' => 'edit','delete' => 'delete','anh_dd' => 'anh_dd'])
                            ->make(true);

    }
    public function editPostDetail($news_id){
        $newsDetail = $this->dbNews->getNewsDetail($news_id);

        if ($newsDetail) {
            return view('admin.post_articles.editpost')->with('detail',$newsDetail);
        } else {
            return 'Not found data';
        }
       
    }
    public function editPostHandle(Request $request){
        Validator::make($request->all(), [
                // yeu cau cua cac input trong form
                'tieu_de' => 'required|max:300',
                'anh_dd' => 'mimes:jpeg,png,bmp,tiff |max:4096',

            ],
            [
                // noi dung thong bao ra view
                'tieu_de.required' => 'Tiêu đề không được để trống',
                'tieu_de.max' => 'Tiêu đề không được quá 300 kí tự',
                'anh_dd.mimes' => 'Yêu cầu chọn đúng định dạng file ảnh JPG, JPEG, PNG, BMP',
            ])->validate();
        // dd($request->input('the_loai'));
        $newsDetail = $this->dbNews->getNewsDetail($request->input('id_baiviet'));
            
        if ($request->hasFile('anh_dd')) {
            $file = $request->file('anh_dd');
            // Lay ten + duoi file
            $fileName = $file->getClientOriginalName();
            // Luu vao upload
            $file->move('upload', $fileName);
            // echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            // 
            // Luu vao csdl
            $update = DB::table('baiviet')
                        ->where('id',$request->input('id_baiviet'))
                        ->update([
                            'tieu_de' => $request->input('tieu_de'),
                            'noi_dung' => $request->input('noi_dung'),
                            'anh_dd' => 'upload/'.$fileName,
                            'id_dm' => $request->input('the_loai'),
                            'updated_at' => date('Y-m-d H:i:s'),
                                ]);
            
        } else {
            //Keep old picture if no file is selected
            $fileNameCurrent = $newsDetail[0]['anh_dd'];
            // Luu vao csdl
            $update = DB::table('baiviet')
                        ->where('id',$request->input('id_baiviet'))
                        ->update([
                            'tieu_de' => $request->input('tieu_de'),
                            'noi_dung' => $request->input('noi_dung'),
                            'anh_dd' => $fileNameCurrent,
                            'id_dm' => $request->input('the_loai'),
                            'updated_at' => date('Y-m-d H:i:s'),
                                ]);
        }


        if($update){
            return back()->with('status-editnews', 'Sửa thành công');
        }else {
            return back()->with('failed-editnews', 'Sửa thất bại');
        }

        
    }

    public function deletePost($news_id){
        $newsDetail = $this->dbNews->find($news_id);
        $newsDelete = $newsDetail->delete();
        
        if ($newsDelete) {
            return back()->with('status-delnews', 'Xóa thành công');
        }else {
            return back()->with('failed-delnews', 'Xóa thất bại');
        }
    }
    public function restorePost(){
        $newsDetail = $this->dbNews->withTrashed();
        $newsRestore = $newsDetail->restore();
        if ($newsRestore) {
            return back();
        }
    }

}
