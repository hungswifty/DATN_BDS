<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class StatisticController extends Controller
{
    public function indexUser(){
    	return view('admin.statistic.statUser');
    }

    public function statisUser(){
    	$data = DB::table('nguoidung')->get();


    	return Datatables::of($data)->make(true);
    }
    public function indexProduct(){
    	return view('admin.statistic.statProduct');
    }
    public function statisProduct(){
    	$data = DB::table('sanpham')->get();

    	return Datatables::of($data)->make(true);
    }
}
