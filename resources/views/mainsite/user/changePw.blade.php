@extends('mainsite.user.index')

@section('content-user')
{{-- @foreach ($data as $value)
@endforeach
--}}
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
		@if (session('status-changepw'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h6 class="text-uppercase m-auto">{{ session('status-changepw') }}</h6>
			</div>
		</div>
		@elseif (session('failed-changepw'))
		<div class="row alert alert-danger text-center">
			<h6 class="text-uppercase m-auto">{{ session('failed-changepw') }}</h6>
		</div>
		@endif
	</div>
	<div class="card-body">	
		<form action="{{ route('user.changePwHandle') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			@csrf
			<div class="form-group mt-3">
				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="matkhau_cu" class="label_user"><small>Mật khẩu cũ</small></label>
					</div>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="matkhau_cu" name="matkhau_cu" required>
					</div>
				</div>

				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="password" class="label_user"><small>Mật khẩu mới</small></label>
					</div>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
				</div>
				<div class="form-row user-content" >
					<div class="col-sm-2">
						<label for="password" class="label_user"><small>Mật khẩu mới</small></label>
					</div>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password_confirmation" required>
					</div>
				</div>

			</div>
			<div class="form-row my-5">
				<button type="submit" name="btnSubmit" class="btn btn-success m-auto">Đổi mật khẩu</button>
			</div>
		</form>
	</div>

@endsection