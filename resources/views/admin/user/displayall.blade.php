@extends('admin.base')

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Quản lý người dùng</a>
		</li>
		<li class="breadcrumb-item active">Danh sách người dùng</li>
	</ol>
	<div class="row">
		<h4 class="text-title m-auto">Danh sách người dùng</h4>
	</div>
	
	@if (session('ADsuccess-delUser'))
	<div class="row alert alert-success">
		<div class="col-md-12 text-center">
			<h6 class="text-uppercase m-auto pb-3">{{ session('ADsuccess-delUser') }}</h6>
			<a href="{{ route('admin.restore-user') }}" title=""><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
		</div>
	</div>
	@elseif(session('ADfailed-delUser'))
	<div class="row alert alert-success text-center">
		<h6 class="text-uppercase m-auto">{{ session('ADfailed-delUser') }}</h6>
	</div>
	@endif		

	<div class="mt-5">
		<table class="table edit_table table-hover table-bordered table-data" id="table-user">
			<thead class="table-info">
				<tr class="text-center">
					<th scope="col" style="width:5%"><small><b>ID</b></small></th>
					<th scope="col" style="width:10%"><small><b>Tên TK</b></small></th>
					<th scope="col"><small><b>Email</b></small></th>
					<th scope="col"><small><b>Họ tên</b></small></th>
					<th scope="col"><small><b>Ảnh đ.diện</b></small></th>
					<th scope="col"><small><b>Giới tính</b></small></th>
					<th scope="col"><small><b>Trạng thái</b></small></th>
					<th scope="col"><small><b>Địa chỉ</b></small></th>
					<th scope="col"><small><b>Số ĐT</b></small></th>
					<th scope="col"><small><b>Số CMND</b></small></th>
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
		var table = $('#table-user').DataTable({

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
        	ajax: "{{ route('admin.user.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ data: 'tentaikhoan'},
	        	{ data: 'email'},
	        	{ data: 'hoten'},
	        	{ data: 'anhdaidien'},
	        	{ data: 'gioitinh'},
	        	{ data: 'status'},
	        	{ data: 'diachi'},
	        	{ data: 'so_dt'},
	        	{ data: 'so_cmnd'},
	        	{ data: 'edit'},
	        	{ data: 'delete'},
        	],

        });

		//style select box
		$(".dataTables_length select").addClass("form-control table-select");
	});
    </script>
@endpush