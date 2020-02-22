<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\News;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	private $dbProduct;
    private $dbNews;

	public function __construct(Product $product, News $news){
		$this->dbProduct = $product;
        $this->dbNews = $news;
	}
    public function index(){
    	//data nhà bán
    	$dataSale = $this->dbProduct->getProductWithImage(1);
    	//data nhà cho thuê
    	$dataRent = $this->dbProduct->getProductWithImage(2);
        //data tin tuc
        $dataNews = $this->dbNews->getAllLatestNewsDESC();
        //
        $dataVIP = $this->dbProduct->getVIPproduct();

        

    	$data = [
    		'dataSale' => $dataSale,
    		'dataRent' => $dataRent,
            'dataNews' => $dataNews,
            'dataVIP' => $dataVIP,
    	];   
        // dd($data);
        // dd($data);
        // dd($dataSale);
        // Du lieu tra ve la 1 object co dang +"id" : ..., phai encode thanh chuoi json roi decode de ve mang?
        $dataDecoded = json_decode(json_encode($data),true);
        // dd($dataDecoded);
    	if ($data) {
    		return view('mainsite.index.index')->with('dataProduct',$dataDecoded);

    	} else {
    		return 'Not found data';
    	}
    }
}
