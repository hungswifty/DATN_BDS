<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Report;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
	private $dbReport;

	public function __construct(Report $report)
	{
		$this->dbReport = $report;
	}
    public function displayReport()
    {
    	return view('admin.report.displayall');
    }
    public function dataForDisplayAllReport(){
    	$data = DB::table('phanhoi')
    				->join('sanpham', 'phanhoi.id_sanpham', '=', 'sanpham.id')
    				->select(DB::raw('phanhoi.id as id, id_sanpham, email, so_dt, phanhoi.noi_dung, ten_sp, phanhoi.created_at as ph_created_at, sanpham.created_at as sp_created_at'))
    				->whereNull('phanhoi.deleted_at')
    				->get();

    	return Datatables::of($data)
                        ->addColumn('delete', function ($data) {
                                    return '<a href="' . route('admin.delete-report', $data->id) .'">'.'<button type="button" class="btn btn-outline-danger" onclick="'."return confirm('Có chắc chắn xóa phản hồi có id= $data->id ')".'">'.'Xóa</button></a>';
                            })
                        ->rawColumns(['delete' => 'delete'])

    					->make(true);
    }

    public function deleteReport($report_id){
    	
    	$reportDetail = $this->dbReport->find($report_id);

    	// dd($productDetail);
        $reportDel = $reportDetail->delete();
        
        if ($reportDel) {
            return back()->with('ADsuccess-delReport', 'Xóa thành công');
        }else {
            return back()->with('ADfailed-delReport', 'Xóa thất bại');
        }
    }

    public function restoreReport(){
    	$reportDetail = $this->dbReport->withTrashed();
        $reportRestore = $reportDetail->restore();
        if ($reportRestore) {
            return back();
        }
    }
}
