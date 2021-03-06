@extends('admin.base')

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Thống kê</a>
		</li>
		<li class="breadcrumb-item active">Thống kê tin rao</li>
	</ol>
	<div class="row">
		<h4 class="text-title m-auto">Thống kê tin rao</h4>
	</div>

	<div class="my-5">
		
	<p id="date_filter" class="w-100">
		<div class="row">
			
		
	    <span id="date-label-from" class="date-label px-3">Từ ngày: </span><input class="date_range_filter date form-control col-sm-3" type="text" id="datepicker_from" class="form-control"  autocomplete="off"/>
	    <span id="date-label-to" class="date-label px-3">đến ngày:</span><input class="date_range_filter date form-control col-sm-3" type="text" id="datepicker_to"  style="display: inherit;" autocomplete="off"/>
	    	</div>
	</p>
	</div>

	<div class="mt-5">
			<table class="table edit_table table-hover table-bordered table-data" id="datatable">
				<thead class="table-info">
					<tr class="text-center">
						<th scope="col" style="width:5%">ID</th>
						<th scope="col" style="width:20%">Tên sản phẩm</th>
						<th scope="col">Loại hình</th>
						<th scope="col">Loại sản phẩm</th>
						<th scope="col">Tình trạng</th>
						<th scope="col">Trạng thái</th>
						<th scope="col">Tạo lúc</th>
						<th scope="col">Vip</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@endsection


@push('script')
	<script>
	$(document).ready(function() {

		
		var oTable = $('#datatable').DataTable({

	            dom: 'lfBrtip',
	            "language": {
	        		"search": "Tìm kiếm:",
	        		"sLengthMenu": "Hiển thị _MENU_ bản ghi",
	        		"info":"Hiển thị _START_ đến _END_ trong _TOTAL_ bản ghi",
	        		"infoFiltered":   "(Lọc từ _MAX_ bản ghi)",
	        	},
	        	buttons: [
	        		{ extend: 'excel', text: 'Xuất Excel',title: 'Thống kê người dùng' },
	        		{ extend: 'pdf', text: 'Xuất PDF',title: 'Thống kê người dùng' },
	        		{ extend: 'print', text: 'In',title: 'Thống kê người dùng' }
	        	],
	        	processing: true,
	        	
	        	// serverSide: true,  bỏ đi mới xài filter được
	        	type: "GET",

	        	ajax: "{{ route('admin.productStat.getData') }}",
	        	columns: [
	        	{ data: 'id'},
	        	{ data: 'ten_sp'},
	        	{ data: 'id_loaihinh'},
	        	{ data: 'id_loaisp'},
	        	{ data: 'tinh_trang'},
	        	{ data: 'trang_thai'},
	        	{ data: 'created_at'},
	        	{ data: 'is_vip'},
	        	],

	        });
		//style select box
		$(".dataTables_length select").addClass("form-control table-select");



		$("#datepicker_from").datepicker({
			"dateFormat": "yy/mm/dd",
			"onSelect": function(date) {
				minDateFilter = new Date(date).getTime();
				console.log(minDateFilter);
				oTable.draw();
			}
		}).keyup(function() {
			minDateFilter = new Date(this.value).getTime();
			oTable.draw();
		});

		$("#datepicker_to").datepicker({
			"dateFormat": "yy/mm/dd",
			"onSelect": function(date) {
				maxDateFilter = new Date(date).getTime();
				console.log(maxDateFilter);
				oTable.draw();
			}
		}).keyup(function() {
			maxDateFilter = new Date(this.value).getTime();
			oTable.draw();
		});

		

		
		minDateFilter = "";
		maxDateFilter = "";
		console.log('abc')
		console.log(minDateFilter+' '+maxDateFilter);

		$.fn.dataTableExt.afnFiltering.push(
			function(oSettings, aData, iDataIndex) {
					if (typeof aData._date == 'undefined') {
					      aData._date = new Date(aData[6]).getTime(); // Your date column is 3, hence aData[3].
					 }
					if (minDateFilter && !isNaN(minDateFilter)) {
					  	if (aData._date < minDateFilter) {
					  		return false;
					  	}
					 }

					if (maxDateFilter && !isNaN(maxDateFilter)) {
					  	if (aData._date > maxDateFilter) {
					  		return false;
					  	}
					}

					return true;
				}
			);
	});
		


    </script>
@endpush