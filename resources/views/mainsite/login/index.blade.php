@extends('mainsite.base')

@section('content')

	<!-- Login form -->
	<div class="container">
	
		<div class="wrapper fadeInDown">
		  <div id="formContent">
		    <!-- Tabs Titles -->
			{{ Session::get('tentaikhoan') }}
		    <!-- Icon -->
		    <div class="fadeIn first">
		      <img src="{{asset('/img/timnhabamien-withoutSlogan.jpg')}}" alt="login icon" id="icon" width="60%" height="auto" />
		      <h3 style="color: #055699;">ĐĂNG NHẬP</h3>
		    </div>
			
			{{-- Error area --}}
			<div class="row">
				<div class="m-auto">
					@if(session('failed'))
					<div class="row alert alert-danger text-center">
						<h6 class="text-uppercase" style="margin: 10px auto;">{{ session('failed') }}</h6>
					</div>
					@endif
				</div>
			</div>
			{{-- End error area--}}


		    <!-- Login Form -->
		    <form action="{{ url('/login') }}" method="POST">
		    @csrf
		      <input type="text" id="login" class="fadeIn second" name="user" placeholder="Tài khoản">
		      <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Mật khẩu">
		      <input type="submit" class="fadeIn fourth" value="Đăng nhập" name="btnLogin">
		      <div class="d-block">
		      	<a href="{{ route('forgotpw') }}" class="underlineHover" style="text-align: center;">Quên mật khẩu?</a>
		      </div>
		      <br>
		    </form>

		    <!-- Remind Passowrd -->
		    <div id="formFooter">
		      <a class="underlineHover" href="index.php">Quay lại trang chủ</a>
		    </div>

		  </div>
		</div>
	</div>
	<!-- End Login form -->
	@endsection