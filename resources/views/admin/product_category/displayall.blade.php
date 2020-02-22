@extends('admin.base')

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Quản lý loại sản phẩm</a>
		</li>
		<li class="breadcrumb-item active">Danh sách loại sản phẩm</li>
	</ol>
	<div class="row">
		<h4 class="text-title m-auto">Danh sách loại sản phẩm</h4>
	</div>
	
	@if (session('ADsuccess-delProCate'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h5 class="text-uppercase m-auto pb-3">{{ session('ADsuccess-delProCate') }}</h5>
				<a href="{{ route('admin.restore-productcate') }}"><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
			</div>
		</div>
	@elseif(session('ADfailed-delProCate'))
		<div class="row alert alert-success text-center">
			<h5 class="text-uppercase m-auto">{{ session('ADfailed-delProCate') }}</h5>
		</div>
	@endif		

	<div class="mt-5">
		<table class="table edit_table table-hover table-bordered table-data" id="table-proCate">
			<thead class="table-info">
				<tr class="text-center">
					<th scope="col" style="width:5%">ID</th>
					<th scope="col">Tên loại sản phẩm</th>
					<th scope="col">Ngày tạo</th>
					<th scope="col"><small><b>Sửa</b></small></th>
					<th scope="col"><small><b>Xóa</b></small></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection

@push('script')
	<script>
	$(document).ready(function() {
		var table = $('#table-proCate').DataTable({

            dom: 'lifrtp',
            "language": {
	        		"search": "Tìm kiếm:",
	        		"sLengthMenu": "Hiển thị _MENU_ bản ghi",
	        		"info":"Hiển thị _START_ đến _END_ trong _TOTAL_ bản ghi",
	        		paginate: {
				      next: '&#8594;', // or '→'
				      previous: '&#8592;' // or '←' 
				    }

	        },
        	// processing: true,
        	serverSide: true,
        	type: "GET",
        	ajax: "{{ route('admin.proCate.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ data: 'loai_sp'},
	        	{ data: 'created_at'},
	        	{ data: 'edit'},
	        	{ data: 'delete'},
        	],

        });

		//style select box
		$(".dataTables_length select").addClass("form-control table-select");
	});
    </script>
@endpush