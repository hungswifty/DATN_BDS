@extends('mainsite.user.index')

@section('content-user')
	@foreach ($data as $value)
		{{-- expr --}}
	@endforeach
	<div class="card-header">
		<h5 class="header-card1"><kbd>Thay đổi thông tin</kbd></h5>
	</div>
	<div class="card-body">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
	<div class="card-body">
		@if (session('status-edituser'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h3 class="text-uppercase">{{ session('status-edituser') }}</h3>
			</div>
		</div>
		@elseif (session('failed-edituser'))
		<div class="row alert alert-success text-center">
			<h3 class="text-uppercase">{{ session('failed-edituser') }}</h3>
		</div>
		@endif
	</div>
	<div class="card-body" style="padding: 0 0;">
		<form action="{{ route('user.change-info-handle') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			@csrf

			<div class="form-group mt-3">
				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="ten_tk" class="label_user"><small>Tên tài khoản</small></label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="ten_tk" name="ten_tk" disabled="disabled" value="{{ $value['tentaikhoan'] }}">
					</div>
				</div>
				
				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="email" class="label_user"><small>Email</small></label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" name="email" disabled="disabled" value="{{ $value['email'] }}">
					</div>
				</div>

				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="ho_ten" class="label_user"><small>Họ và tên</small></label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="ho_ten" name="ho_ten" value="{{ $value['hoten'] }}">
					</div>
				</div>

				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="gioitinh"><small>Giới tính</small></label>
					</div>
					<div class="col-sm-10" style="padding-left:10px;">
						{{-- 0 = nu / 1 = nam --}}
						@if ($value['gioitinh'] == 0)
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gioi_tinh" value="1" >
								<span class="form-check-label"> Nam </span>
							</label>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gioi_tinh" value="0" checked>
								<span class="form-check-label" > Nữ</span>
							</label>
						@else
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gioi_tinh" value="1" checked>
								<span class="form-check-label"> Nam </span>
							</label>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gioi_tinh" value="0">
								<span class="form-check-label"> Nữ</span>
							</label>
						@endif
					</div>
				</div>

				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="dia_chi" class="label_user"><small>Địa chỉ</small></label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ $value['diachi'] }}">
					</div>
				</div>

				<div class="form-row user-content" >
					<div class="col-sm-6">
						<div class="form-row">
							<div class="col-sm-4 pt-2">
								<label for="so_cmnd" class="label_user"><small>Số CMND</small></label>
							</div>

							<div class="col-sm-6">
								<input type="text" class="form-control" id="so_cmnd" name="so_cmnd" value="{{ $value['so_cmnd'] }}"> 
							</div>
						</div>

					</div>

					<div class="col-sm-6">
						<div class="form-row">
							<div class="col-sm-4 pt-2">
								<label for="so_dt" class="label_user"><small>Số điện thoại</small></label>
							</div>

							<div class="col-sm-6">
								<input type="text" class="form-control" id="so_dt" name="so_dt" value="{{ $value['so_dt'] }}">
							</div>
						</div>
					</div>
				</div>

				<div class="form-row user-content">
					<div class="col-sm-6">
						<div class="form-row">
							<div class="col-sm-4 pt-2">
								<label for="so_cmnd"><small>Chọn ảnh đại diện</small></label>
							</div>

							<div class="col-sm-6" style="padding-left:10px;">
								<input type="file" name="avatar">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-row user-content my-5">
					<button type="submit" name="btnSubmit" class="btn btn-success m-auto">Lưu lại thông tin</button>
				</div>
			</div>
		</form>	
	</div>
@endsection