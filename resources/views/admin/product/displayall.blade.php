@extends('admin.base')

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Quản lý sản phẩm</a>
		</li>
		<li class="breadcrumb-item active">Danh sách sản phẩm</li>
	</ol>
	<div class="row">
		<h4 class="text-title m-auto">Danh sách sản phẩm</h4>
	</div>

	@if (session('ADsuccess-delproduct'))
	<div class="row alert alert-success">
		<div class="col-md-12 text-center">
			<h6 class="text-uppercase m-auto pb-3">{{ session('ADsuccess-delproduct') }}</h6>
			<a href="{{ route('admin.restore-product') }}" title=""><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
		</div>
	</div>
	@elseif(session('ADfailed-delproduct'))
	<div class="row alert alert-success text-center">
		<h6 class="text-uppercase m-auto">{{ session('ADfailed-delproduct') }}</h6>
	</div>
	@endif			

	<div class="mt-5">
		<table class="table edit_table table-hover table-bordered table-data" id="table-product">
			<thead class="table-info">
				<tr class="text-center">
					<th scope="col" style="width:5%">ID</th>
					<th scope="col" style="width:20%">Tên sản phẩm</th>
					<th scope="col">Khu vực</th>
					<th scope="col">Đăng bởi</th>
					<th scope="col">Tình trạng</th>
					<th scope="col">Trạng thái</th>
					<th scope="col">Đăng lúc</th>
					<th scope="col">VIP</th>
					<th scope="col">Sửa</th>
					<th scope="col">Xóa</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection

@push('script')
	<script>
	$(document).ready(function() {
		var table = $('#table-product').DataTable({
            // "paging":   false,
            // "info":     false,

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
        	ajax: "{{ route('admin.product.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ data: 'ten_sp'},
	        	{ 	data: 'ten_tinhthanh',
		        	render: function (data, type, row, meta) {
		        		return row.ten_khuvuc + ', ' + row.ten_tinhthanh + ', ' + row.ten_quanhuyen;
		        		}
	        	},
	        	{ data: 'tentaikhoan'},
	        	{ data: 'tinh_trang'},
	        	{ data: 'trang_thai'},
	        	{ data: 'created_at'},
	        	{ data: 'is_vip'},
	        	{ data: 'edit'},
	        	{ data: 'delete'},
        	],

        });

		//style select box
		$(".dataTables_length select").addClass("form-control table-select");
	});
    </script>
@endpush