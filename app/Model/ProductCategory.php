<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    protected $table = 'loaisanpham';
    use SoftDeletes;

    public function getAllDataProductCategory()
    {
    	$data = ProductCategory::all();
    	return $data;
    }
}
