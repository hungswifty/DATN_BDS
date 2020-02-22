<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\News;
use Validator;

class NewsController extends Controller
{
	private $dbNews;

	public function __construct(News $news){
		$this->dbNews = $news;
	}
    public function index(){
    	// return view('mainsite.news.index');
    	$dataTN = $this->dbNews->getNewsTN();
    	$dataQT = $this->dbNews->getNewsQT();
    	$data = [
    		'dataTN' => $dataTN,
    		'dataQT' => $dataQT
    	];

    	// foreach ($data['dataTN'] as $key => $value) {
    	// 	echo $value['anh_dd'];
    	// }

    	if ($data) {
    		return view('mainsite.news.index')->with('data',$data);

    	} else {
    		return 'Not found data';
    	}
    }
    public function detail($news_id){
        $newsDetail = $this->dbNews->getNewsDetail($news_id);
        $newsCate = $this->dbNews->getNewsWithSameCategory($newsDetail[0]['id_dm']);

        $comment = $this->dbNews->getNewsDetailWithCommentbyID($news_id);
        $comment = json_decode(json_encode($comment),true); //to data
        
        $data = [
            'newsDetail' => $newsDetail,
            'newsCate' => $newsCate,
            'comment' => $comment,
        ];
        // dd($data);
        if ($newsDetail) {
            return view('mainsite.news.detail')->with('data',$data);
        } else {
            return 'Not found data';
        }
        // Làm trang hiển thị bài, truyền vào data vừa lấy để hiển thị bài viết
    }
    public function comment($news_id, $tieude = null ,Request $request){
        
        Validator::make($request->all(), [
            // yeu cau cua cac input trong form
          'noi_dung' => 'required|max:300',
        ],
        [
          // noi dung thong bao ra view
         'noi_dung.required' => 'Nội dung không được để trống',
         'noi_dung.max' => 'Nội dung bình luận không được quá 300 ký tự',
        ])->validate();

        $id_baiviet = $news_id;
        $id_nguoidung = session()->get('id');  
        $noi_dung = $request->input('noi_dung');      
        
        if ($noi_dung != null) {
            $InsertToBinhLuan = DB::table('binhluan')->insertGetId([
                    'id_baiviet' => $id_baiviet,
                    'id_nguoidung' => $id_nguoidung,
                    'noi_dung' => $noi_dung,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => null
            ]);
        }
        if ($InsertToBinhLuan) {
            return back();
        }
        
    }
    
    

}
