@extends('mainsite.base')

@section('content')

<div class="container">
	<br>  <p class="text-center"> Đăng ký để biết nhiều thêm thông tin hơn tại <a href="index.php"> timnhabamien.com </a></p>
	<hr>

	<div class="row justify-content-center">
		<div class="col-md-6">
			{{-- Error notification --}}
			<div class="row">
				@if ($errors->any())
				<div class="alert alert-danger m-auto" style="width:95%;height:auto;">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
			{{-- Notif when submited --}}
			@if (session('status-register'))
				<div class="row alert alert-success">
					<div class="col-md-12 text-center">
			        	<h3 class="text-uppercase">{{ session('status-register') }}</h3>
					</div>
			    </div>
			@elseif(session('failed-register'))
				<div class="row alert alert-danger text-center">
					<h6 class="text-uppercase" style="margin: 10px auto;">{{ session('failed-register') }}</h6>
					<a href="{{ route('login') }}" class="badge badge-pill badge-warning" style="margin-left:auto; margin-right:auto;"><p class="text-center" style="margin:auto;">Đã có tài khoản? Đăng nhập</p></a>
				</div>
			@endif

			{{-- End error notif --}}
			<div class="card">
				<header class="card-header">
					<a href="{{ route('login') }}" class="float-right btn btn-outline-primary mt-1">Đăng nhập</a>
					<h4 class="card-title mt-2">Đăng ký</h4>
				</header>
				<article class="card-body">
					<form method="POST" action="{{ route('register-handle') }}" class="form_register">
						
						@csrf
						
							<div class="form-row">
									<div class="col form-group">
										<label>Tên đăng nhập (*)</label>
										<input type="text" class="form-control" placeholder="" name="tentk" required>
										<small class="form-text text-muted">Tên đăng nhập cần có nhiều hơn 8 kí tự</small>
									</div> 
								<div class="col form-group">
									<label>Địa chỉ email (*)</label>
									<input type="email" class="form-control" placeholder="example@abc.com" name="email" style="margin: 5px 5px;" required>
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
							<div class="col form-group">
								<label>Captcha</label>
								<input type="text" class="form-control" disabled="disabled" id="cau_hoi">
							</div>
							<div class="col form-group">
								<label>Nhập kết quả (*)</label>
								<input type="text" class="form-control" id="tra_loi" required>
								<small class="form-text text-muted">Nhập kết quả bằng số</small>
							</div>
						</div>

						<div class="form-row">
							<button type="submit" class="btn btn-primary btn-block"> Đăng ký </button>
						</div>      

						<small class="text-muted">Bằng cách nhấn vào Đăng ký, bạn đồng ý với các Điều khoản thỏa thuận, Quy chế hoạt động, Chính sách bảo mật thông tin, Cơ chế giải quyết khiếu nại,... của Chúng tôi </small>                                          
					</form>
				</article> <!-- card-body end .// -->
				<div class="border-top card-body text-center">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></div>
			</div> <!-- card.// -->
		</div> <!-- col.//-->

	</div> <!-- row.//-->

	<hr>

</div> 

@endsection