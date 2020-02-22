<?php

namespace App\Http\Controllers\MainSite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Users;

class ProductDetailController extends Controller
{
	private $dbProductDetail;
	private $dbUser;
	public function __construct(Product $product, Users $user){
		$this->dbProductDetail = $product;
		$this->dbUser = $user;
	}
    public function index($product_id){
    	$dataPrDetail = $this->dbProductDetail->getProductWithImagebyID($product_id);
    	$dataPrDetail = json_decode(json_encode($dataPrDetail),true);

    	$dataImg = $this->dbProductDetail->getAllImagebyProductID($product_id);
    	$dataImg = json_decode(json_encode($dataImg),true);

    	// dd($dataPrDetail);

    	foreach ($dataPrDetail as $value) {
    		$dataUser = $this->dbUser->getDataUser($value['id_nguoidung']);
    		$dataTinhThanh = $this->dbProductDetail->getProductbyProvinceID($value['id_tinhthanh']);
    	}

    	$dataTinhThanh = json_decode(json_encode($dataTinhThanh),true);


    	$data =[
    		'productDetail' => $dataPrDetail,
    		'productImages' => $dataImg,
    		'dataUser' => $dataUser,
    		'dataProvince' => $dataTinhThanh,
    	];
    	
    	// dd($data);

    	if ($data) {
    		return view('mainsite.product.index')->with('data', $data);
    	} else {
    		return view('mainsite.index.index');
    	}
    	
    }
}
