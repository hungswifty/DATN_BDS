<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Area;

class TestController extends Controller
{

    public function index(){
    	// $data = $this->dbArea->getAllAPDdata();
    	$data = DB::table('khuvuc')->select('id','ten_khuvuc')->get();
    	// dd($data);
    	return view('mainsite.testview')->with('data',$data);
    }
    public function fetchTT(Request $request){

    	// if($request->ajax()){
    	// 	echo 'Ajax';
    	// } else {
    	// 	echo 'No Ajax';
    	// }

    	$select = $request->input('select');
    	$value = $request->input('value');
    	$dependent = $request->input('dependent');
    	
    	$data = DB::table('khuvuc')
    			->join('tinhthanh', 'tinhthanh.id_khuvuc', '=', 'khuvuc.id')
                ->join('quanhuyen', 'quanhuyen.id_tinhthanh', '=','tinhthanh.id')
                ->select(DB::raw('khuvuc.id as id_khuvuc, tinhthanh.id as id_tinhthanh, quanhuyen.id as id_quanhuyen, ten_khuvuc, ten_tinhthanh, ten_quanhuyen'))
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();

    	$output["dataTT"] = $data;
    	
    	// foreach($data as $row)
    	// {
    	// 	$output = $row->id_khuvuc;
    	// }
    	
    	$output1 = json_encode($output);
    	// var_dump($output['data']);
    	echo $output1;


    }

    public function fetchQH(Request $request){
    	$select = $request->input('select');
    	$value = $request->input('value');
    	$dependent = $request->input('dependent');

    	$data = DB::table('khuvuc')
    			->join('tinhthanh', 'tinhthanh.id_khuvuc', '=', 'khuvuc.id')
                ->join('quanhuyen', 'quanhuyen.id_tinhthanh', '=','tinhthanh.id')
                ->select(DB::raw('khuvuc.id as id_khuvuc, tinhthanh.id as id_tinhthanh, quanhuyen.id as id_quanhuyen, ten_khuvuc, ten_tinhthanh, ten_quanhuyen'))
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();

    	$output["dataQH"] = $data;
    	
    	$output2 = json_encode($output);
    	// var_dump($output1['dataQH'].id_quanhuyen);
    	
    	echo $output2;
    }
    
}
