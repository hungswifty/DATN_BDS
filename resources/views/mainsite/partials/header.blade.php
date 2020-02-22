<!-- Header -->
<header>
	<div class="container" style="padding: 0 0;">
		<div class="row">
			<div class="col-sm-12">
				<div class="banner">
					<div class="logo">
						<img class="img-fluid" src="{{ asset('img/timnhabamien1.jpg') }}" alt="logo" width="333" height="150">
					</div>
					<div class="detail">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel" width="100%" height="100%">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block w-100 inner-img" src="{{ asset('img/banner-detail.png') }}" alt="Thông tin quảng cáo 1">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100 inner-img" src="{{ asset('img/banner-detail.png') }}" alt="Thông tin quảng cáo 2">
								</div>
								<div class="carousel-item">
									<img class="d-block w-100 inner-img" src="{{ asset('img/banner-detail.png') }}" alt="Thông tin quảng cáo 3">
								</div>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<div class="user-detail">
						@if (session()->has('tentaikhoan'))
						<div class="mybox1">
							<div class="row">
								<div class="col-sm-4">
									<div class="mybox4 mybox5" style="width:auto !important;">
										<img src="{{ asset('img/facebook.png') }}" alt="facebook">
										<img src="{{ asset('img/instagram.png') }}" alt="instagram">
										<img src="{{ asset('img/twitter.png') }}" alt="twitter">
									</div>
								</div>
								<div class="col-sm-8">
									<div class="user-info">
										<button type="button" class="btn btn-success font-weight-bold btn-post"><a href="{{ route('upload-product') }}" title="Đăng tin"><b>Đăng tin rao</b></a></button>

										<a href="{{ route('user.index') }}" class="font-weight-bold user-info-a" title="Trang cá nhân" ><img class="img-user" src="{{ session()->get('anhdaidien') }}"> {{ session()->get('tentaikhoan') }} </a>

										<button type="button" class="btn btn-secondary btn-logout"><a href="{{ route('logout') }}" title="Đăng xuất"><b>Đăng xuất</b></a></button>
									</div>
								</div>
							</div>					
						</div>
						@else
							<div class="btn-box mybox1 mybox2">
								<a href="{{ route('register') }}" class="btn-log font-weight-bold nav-btn"><img src="{{ asset('img/register.png') }}" alt="reg"> Đăng ký </a>
								<a href="{{ route('login') }}" class="btn-log font-weight-bold nav-btn"><img src="{{ asset('img/login.png') }}" alt="login"> Đăng nhập </a>								
							</div>
							<div class="mybox4">
								<img src="{{ asset('img/facebook.png') }}" alt="facebook">
								<img src="{{ asset('img/instagram.png') }}" alt="instagram">
								<img src="{{ asset('img/twitter.png') }}" alt="twitter">
								<button type="button" class="btn btn-success font-weight-bold btn-post"><a href="{{ route('upload-product') }}" title="Đăng tin"><b>Đăng tin rao</b></a></button>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</header>