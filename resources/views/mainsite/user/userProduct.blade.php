@extends('mainsite.base')

@section('content')

@foreach ($data['dataUser'] as $key => $value)
	{{-- expr --}}
@endforeach
<div class="container" style="min-height:400px;">
	<div class="row pt-3">
		<div class=" col-sm-3">
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1"><kbd>Trang cá nhân</kbd></h5>
				</div>
				<div class="card-body" style="padding: 0 0;">
					<div class="user-avatar text-center py-5">
						{{-- if anh dai dien = null, hien anh mac dinh , else hien anh trong fdb --}}
						@if ($value['anhdaidien'])
							<img src="../{{ $value['anhdaidien'] }}" alt="Ảnh đại diện" width="130" height="130">
						@else
							<img src="{{ asset('upload/user/person-icon.png') }}" alt="Ảnh đại diện" width="130" height="130">
						@endif
						
					</div>
				</div>
				<div class="card-body" style="padding: 0 0;">
					<div class="vertical-menu">
						<a class="active" disabled>Quản lý thông tin cá nhân</a>
						<a href="{{ route('user.change-info') }}">Thay đổi thông tin cá nhân</a>
						<a href="{{ route('user.change-pw') }}">Thay đổi mật khẩu</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Quản lý tin rao</a>
						<a href="{{ route('user.user-product') }}">Quản lý tin rao bán/cho thuê</a>
						<a href="{{ route('upload-product') }}">Đăng tin rao bán, cho thuê</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Tiện ích</a>
						<a href="{{ route('user.mailbox') }}">Hộp tin nhắn</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Khác</a>
						<a href="#">Hướng dẫn sử dụng</a>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-sm-9">
			<div class="card" style="width: 100%;">
				<div class="card-body" style="padding: 0 0;">
					<div class="card-header">
						<h5 class="header-card1"><kbd>Quản lý tin rao bán, cho thuê</kbd></h5>
					</div>
					<div class="card-body">
						<table class="table edit_table table table-hover">
							<thead class="table-info">
								<tr class="text-center">
									<th scope="col"><small><b>STT</b></small></th>
									<th scope="col"><small><b>Tên bài</b></small></th>
									<th scope="col"><small><b>Loại hình</b></small></th>
									<th scope="col"><small><b>Loại sản phẩm</b></small></th>
									<th scope="col"><small><b>Khu vực</b></small></th>
									<th scope="col"><small><b>Diện tích</b></small></th>
									<th scope="col"><small><b>Giá tiền</b></small></th>
									<th scope="col"><small><b>Tình trạng</b></small></th>
									<th scope="col"><small><b>Hành động</b></small></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data['dataProduct'] as $key => $value)
									<tr class="text-center">
										<th>{{ $key + 1}}</th>
										<td><small>{{ Str::words($value->ten_sp,8,'...') }}</small></td>
										<td><small>{{ $value->ten_loaihinh }}</small></td>
										<td><small>{{ $value->loai_sp }}</small></td>
										<td><small>{{ $value->ten_tinhthanh }}, {{ $value->ten_quanhuyen }}</small></td>
										<td><small>{{ $value->dien_tich }} m2</small></td>
										@if ($value->gia_tien != null)
											<td><small>{{ $value->gia_tien }}</small></td>
										@else
											<td><small>Thỏa thuận</small></td>
										@endif
										@if ($value->tinh_trang == 0)
											<td><small>Hiển thị</small></td>
										@else 
											<td><small>Ẩn</small></td>
										@endif

										<td><a href="{{ route('user.edit-product',[ 'id_sanpham' => $value->id ]) }}" title=""><button type="button" class="btn btn-success">Sửa</button></a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="row">
							<div class="m-auto">
								{{ $data['dataProduct']->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@push('scripts')
	<script>
		$(document).ready(function() {           

				$(".img-user").attr("src", function(i, val) {
				  return '../../../'+val; //i == index, val == original attribute, the id
				});

		});
	</script>
@endpush