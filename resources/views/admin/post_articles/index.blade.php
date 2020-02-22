@extends('admin.base')

@section('content')
<div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý bài viết</a>
              </li>
              <li class="breadcrumb-item active">Danh sách bài viết</li>
            </ol>
            <div class="row">
                <h4 class="text-title m-auto">Danh sách bài viết</h4>
            </div>

			@if (session('status-delnews'))
				<div class="row alert alert-success">
					<div class="col-md-12 text-center">
			        	<h6 class="text-uppercase m-auto pb-3">{{ session('status-delnews') }}</h6>
			        	<a href="{{ route('admin.restore-post') }}" title=""><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
					</div>
			    </div>
			@elseif(session('failed-delnews'))
				<div class="row alert alert-success text-center">
					<h6 class="text-uppercase">{{ session('failed-delnews') }}</h6>
				</div>
			@endif

			
			<table class="table edit_table table table-hover" id="table-news">
			  <thead class="table-info">
			    <tr class="text-center">
			      <th scope="col">ID</th>
			      <th scope="col">Tiêu đề</th>
			      <th scope="col" style="width: 10%;">Nội dung</th>
			      <th scope="col">Ảnh đại diện</th>
			      <th scope="col">Danh mục</th>
			      <th scope="col">Ngày đăng</th>
			      <th scope="col">Sửa</th>
			      <th scope="col">Xóa</th>

			    </tr>
			  </thead>
			  	
			</table>

</div>
@endsection

@push('script')
	<script>
	$(document).ready(function() {
		var table = $('#table-news').DataTable({
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
        	ajax: "{{ route('admin.edit-post.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ data: 'tieu_de'},
	        	{ data: 'noi_dung'},
	        	{ data: 'anh_dd'},
	        	{ data: 'id_dm'},
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