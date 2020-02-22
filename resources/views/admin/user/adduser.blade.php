@extends('admin.base')

@section('content')
	<div class="container-fluid">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="#">Quản lý sản phẩm</a>
			</li>
			<li class="breadcrumb-item active">Thêm sản phẩm</li>
		</ol>
		<div class="card">
				<header class="card-header">
					<h4 class="card-title mt-2 text-info">Thêm mới người dùng</h4>
				</header>
				<article class="card-body">
					<div class="row">
						@if (session('status-addUser'))
						<div class="row alert alert-success my-3 mx-auto">
							<div class="col-md-12 text-center my-3 mx-auto">
								<h5 class="text-uppercase">{{ session('status-addUser') }}</h5>
							</div>
						</div>
						@elseif(session('failed-addUser'))
						<div class="row alert alert-danger my-3 mx-auto">
							<h5 class="text-uppercase my-3 mx-auto">{{ session('failed-addUser') }}</h5>
						</div>
						@endif
					</div>

					<form method="POST" action="{{ route('admin.add-user-handle') }}" class="form_register">
						
						@csrf
						
							<div class="form-row">
									<div class="col form-group">
										<label>Tên đăng nhập (*)</label>
										<input type="text" class="form-control" placeholder="" name="tentk" required>
									</div> 
								<div class="col form-group">
									<label>Địa chỉ email (*)</label>
									<input type="email" class="form-control" placeholder="example@abc.com" name="email" required>
								</div>
							</div>
						
						<div class="form-row">
							<div class="col form-group">
								<label>Mật khẩu (*)</label>   
								<input type="password" class="form-control" name="password" required>
								<small class="form-text text-muted">Mật khẩu cần dài hơn 6 kí tự và bao gồm cả chữ và số</small>
							</div>
							<div class="col form-group">
								<label>Nhập lại mật khẩu (*)</label>
								<input type="password" class="form-control" name="password_confirmation" required>
							</div>
						</div>

						<div class="form-row">
							<div class="col form-group">
								<label>Họ và tên (*)</label>   
								<input type="text" class="form-control" name="hoten" required>
							</div>
							<div class="col form-group">
								<label>Số điện thoại</label>
								<input type="text" class="form-control numberOnly" name="sodt" required> 
							</div>
						</div>
						<!-- form-group end.// -->
						<div class="form-group">
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" value="1" required>
								<span class="form-check-label"> Nam </span>
							</label>
							<label class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" value="0">
								<span class="form-check-label"> Nữ</span>
							</label>
						</div> <!-- form-group end.// -->
						<div class="form-row">
							<div class="col form-group">
								<label>Địa chỉ (*)</label>
								<input type="text" class="form-control" name="diachi" required>
							</div> <!-- form-group end.// -->
							<div class="col form-group">
								<label>Số CMND (*)</label>
								<input type="text" class="form-control numberOnly" name="socmnd"  required>
							</div>
						</div> <!-- form-row.// -->

						<div class="form-row">
							<button type="submit" class="btn btn-primary btn-block"> Thêm mới </button>
						</div>      
                                          
					</form>
				</article> <!-- card-body end .// -->
				
			</div>
	</div>
@endsection