@extends('mainsite.base')

@section('content')
@foreach ($data as $value)
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
					@yield('content-user')
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