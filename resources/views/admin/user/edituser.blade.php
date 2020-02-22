


@extends('admin.base')

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Quản lý người dùng</a>
			</li>
			<li class="breadcrumb-item active">Sửa thông tin người dùng</li>
		</ol>
		<div class="card">
				<header class="card-header">
					<h4 class="card-title mt-2 text-info">Sửa thông tin người dùng</h4>
				</header>
				<article class="card-body">
					<div class="row">
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif

						@if (session('ADstatus-editUser'))
						<div class="row alert alert-success my-3 mx-auto">
							<div class="col-md-12 text-center my-3 mx-auto">
								<h3 class="text-uppercase">{{ session('ADstatus-editUser') }}</h3>
							</div>
						</div>
						@elseif(session('ADfailed-editUser'))
						<div class="row alert alert-danger my-3 mx-auto">
							<h6 class="text-uppercase my-3 mx-auto">{{ session('ADfailed-editUser') }}</h6>
						</div>
						@endif
					</div>

					<form method="POST" action="{{ route('admin.edit-user-handle') }}" enctype="multipart/form-data">
						
						@csrf
						@foreach ($data as $value)
							{{-- expr --}}
						@endforeach

						<div class="form-row">
							<div class="col form-group">
								<label>ID</label>
								<input type="text" class="form-control" name="id_nguoidung" value="{{ $value->id }}" readonly>
							</div>
							<div class="col form-group">
								<label>Trạng thái</label>
								<select class="custom-select mr-sm-2" id="trang_thai" name="trang_thai" required>
									@if ($value->status == 1)
									<option value="1" selected="selected">Kích hoạt</option>
									<option value="0">Khóa</option>
									@else
									<option value="1">Kích hoạt</option>
									<option value="0" selected="selected">Khóa</option>
									@endif
								</select>
							</div> 
						</div>

						<div class="form-row">
							<div class="col form-group">
								<label>Tên đăng nhập (*)</label>
								<input type="text" class="form-control" placeholder="" name="tentk" value="{{ $value->tentaikhoan }}" required>
							</div> 
							<div class="col form-group">
								<label>Địa chỉ email (*)</label>
								<input type="email" class="form-control" placeholder="example@abc.com" name="email" value="{{ $value->email }}" required>
							</div>
						</div>

{{-- 						<div class="form-row">
							<div class="col form-group">
								<label>Mật khẩu (*)</label>   
								<input type="password" class="form-control" name="password" required>
								<small class="form-text text-muted">Mật khẩu cần dài hơn 6 kí tự và bao gồm cả chữ và số</small>
							</div>
							<div class="col form-group">
								<label>Nhập lại mật khẩu (*)</label>
								<input type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div> --}}

						<div class="form-row">
							<div class="col form-group">
								<label>Họ và tên (*)</label>   
								<input type="text" class="form-control" name="hoten" value="{{ $value->hoten }}" required>
							</div>
							<div class="col form-group">
								<label>Số điện thoại</label>
								<input type="text" class="form-control numberOnly" name="sodt" value="{{ $value->so_dt }}" required> 
							</div>
						</div>
						<!-- form-group end.// -->
						<div class="form-group">
							@if ($value->gioitinh == 0)
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="1" >
									<span class="form-check-label"> Nam </span>
								</label>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="0" checked>
									<span class="form-check-label" > Nữ</span>
								</label>
							@else
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="1" checked>
									<span class="form-check-label"> Nam </span>
								</label>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="0">
									<span class="form-check-label"> Nữ</span>
								</label>
							@endif
						</div> <!-- form-group end.// -->
						<div class="form-row">
							<div class="col form-group">
								<label>Địa chỉ (*)</label>
								<input type="text" class="form-control" name="diachi" value="{{ $value->diachi }}" required>
							</div> <!-- form-group end.// -->
							<div class="col form-group">
								<label>Số CMND (*)</label>
								<input type="text" class="form-control numberOnly" name="socmnd" value="{{ $value->so_cmnd }}" required>
							</div>
						</div> <!-- form-row.// -->
						<div class="form-row user-content">
							<div class="col form-group">
								<label>Ảnh hiện tại</label>
								@if ($value->anhdaidien == null)
									<img src="../../upload/user/person-icon.png" alt="Ảnh hiện tại" width="100" height="100" class="ml-5">
								@else
									<img src="../../{{ $value->anhdaidien }}" alt="Ảnh hiện tại" width="100" height="100" class="ml-5">
								@endif
							</div>
							<div class="col form-group">
								<label for="avatar" class="mt-4">Chọn ảnh đại diện</label>
								<input type="file" name="avatar">
							</div>
						</div>

						<div class="form-row">
							<button type="submit" class="btn btn-primary btn-block"> Lưu thông tin </button>
						</div>      
                                          
					</form>
				</article> <!-- card-body end .// -->
				
			</div>
	</div>
@endsection