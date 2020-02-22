@extends('admin.base')

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Quản lý phản hồi</a>
		</li>
		<li class="breadcrumb-item active">Danh sách phản hồi</li>
	</ol>
	<div class="row">
		<h4 class="text-title m-auto">Danh sách phản hồi</h4>
	</div>
	
	@if (session('ADsuccess-delReport'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h5 class="text-uppercase m-auto pb-3">{{ session('ADsuccess-delReport') }}</h5>
				<a href="{{ route('admin.restore-report') }}"><button class="btn btn-outline-warning font-weight-normal"><img src="{{ asset('img/undo.png') }}"><b> Hoàn tác </b></button></a>
			</div>
		</div>
	@elseif(session('ADfailed-delReport'))
		<div class="row alert alert-success text-center">
			<h5 class="text-uppercase m-auto">{{ session('ADfailed-delReport') }}</h5>
		</div>
	@endif		

	<div class="mt-5">
		<table class="table edit_table table-hover table-bordered table-data" id="table-Report">
			<thead class="table-info">
				<tr class="text-center">
					<th scope="col" style="width:5%"><small><b>ID</b></small></th>
					<th scope="col" style="width:10%"><small><b>ID Bài đăng</b></small></th>
					<th scope="col"><small><b>Email</b></small></th>
					<th scope="col"><small><b>Số ĐT</b></small></th>
					<th scope="col" style="width:25%"><small><b>Nội dung phản hồi</b></small></th>
					<th scope="col"><small><b>Thời gian</b></small></th>
					<th scope="col"><small><b>Xóa</b></small></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection

@push('script')
	<script>
	function format ( d ) {
    return 'ID: ' + d.id_sanpham +'<br>'+
    	 'Tên bài đăng: ' + d.ten_sp+'<br>'+
        'Ngày đăng: '+d.sp_created_at+'<br>';
	}

	$(document).ready(function() {
		var dt = $('#table-Report').DataTable({

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
        	ajax: "{{ route('admin.report.getData') }}",
        	columns: [
	        	{ data: 'id'},
	        	{ 
	        		"className": "details-control",
	        		data: 'id_sanpham',
	        	},
	        	{ data: 'email'},
	        	{ data: 'so_dt'},
	        	{ data: 'noi_dung'},
	        	{ data: 'ph_created_at'},
	        	{ data: 'delete'},
        	],

        });

		//style select box
		$(".dataTables_length select").addClass("form-control table-select");

		var detailRows = [];

		$('#table-Report tbody').on( 'click', 'tr td.details-control', function () {
			console.log('abc');
			var tr = $(this).closest('tr');
			var row = dt.row( tr );
			var idx = $.inArray( tr.attr('id'), detailRows );

			if ( row.child.isShown() ) {
				tr.removeClass( 'details' );
				row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
        	tr.addClass( 'details' );
        	row.child( format( row.data() ) ).show();

            // Add to the 'open' array
            if ( idx === -1 ) {
            	detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
    	$.each( detailRows, function ( i, id ) {
    		$('#'+id+' td.details-control').trigger( 'click' );
    	} );
    } );

	});

    </script>
@endpush