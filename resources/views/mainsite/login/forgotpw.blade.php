@extends('mainsite.base')

@section('content')

<div class="container" style="height:300px">
	<hr>
	<div class="row">
		<div class="col-lg-12 text-center">
			@if (session('status'))
				<div class="row alert alert-success">
					<div class="col-md-12 text-center">
			        	<h5 class="text-uppercase">{{ session('status') }}</h5>
					</div>
			    </div>
			@elseif(session('failed'))
				<div class="row alert alert-danger text-center">
					<h6 class="text-uppercase" style="margin: 10px auto;">{{ session('failed') }}</h6>
				</div>
			@endif
			<h5 class="m-auto">Vui lòng nhập vào email bạn đã đăng ký!</h5>
		</div>
		<div class="col-lg-12 text-center">
			<form action="{{ route('sendmail') }}" method="post" accept-charset="utf-8">
				
				@csrf
				
				
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-7">
					<input type="email" class="form-control-plaintext text-center" id="staticEmail" name="email_address">
				</div>
				<div class="col-sm-2">
					<button class="btn btn-info btn-block">Gửi</button>
				</div>

			</div>
		</form>
		</div>
		
</div>
</div>
<hr>
@endsection