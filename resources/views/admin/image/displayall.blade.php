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

			@if (session('ADsuccess-delImage'))
				<div class="row alert alert-success">
					<div class="col-md-12 text-center">
			        	<h6 class="text-uppercase m-auto pb-3">{{ session('ADsuccess-delImage') }}</h6>
			        	<a href="{{ route('admin.restore-image') }}" title=""><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
					</div>
			    </div>
			@elseif(session('ADfailed-delImage'))
				<div class="row alert alert-success text-center">
					<h6 class="text-uppercase m-auto">{{ session('ADfailed-delImage') }}</h6>
				</div>
			@endif

			
			<table class="table edit_table table-hover table-bordered table-data" id="table-image">
			  <thead class="table-info">
			    <tr class="text-center">
			      <th scope="col" style="width:5%">ID</th>
			      <th scope="col" style="width:10%">ID Sản phẩm</th>
			      <th scope="col">Nguồn ảnh</th>
			      <th scope="col">Hình ảnh</th>
			      <th scope="col" style="width:10%">Sửa</th>
			      <th scope="col" style="width:10%">Xóa</th>
			    </tr>
			  </thead>
			  
			</table>

</div>
@endsection

@push('script')
	<script>
      $(document).ready(function() {
        $('#table-image').DataTable({
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
        	type: "POST",
        	ajax: "{{ route('admin.image.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ data: 'id_sanpham'},
	        	{ data: 'nguon_anh'},
	        	{ data: 'hinh_anh'},
	        	{ data: 'edit'},
	        	{ data: 'delete'},
        	],
        
        });
        //style select box
        $(".dataTables_length select").addClass("form-control table-select");

      } );
    </script>
@endpush