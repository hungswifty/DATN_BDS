@extends('mainsite.base')

@section('content')

<div class="container" style="padding: 0px 0px;">

	<div class="carousel_1">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="2000">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
						<img src="{{ asset('upload/product/anhnha321.png') }}" class="w-100" alt="Can't load this picture">
					<div class="carousel-caption">
						<h5>Bài đăng tiêu biểu</h5>
					</div>
				</div>
				@foreach ($dataProduct['dataVIP'] as $value)
					<div class="carousel-item">
						<img @if ($value['nguon_anh'] != null)
							src="{{ $value['nguon_anh'] }}" 
						@else
							src="{{ asset('upload/product/no-image.png') }}"
						@endif
						class="w-100" alt="Can't load this picture">
						<div class="carousel-caption">
							<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><h5>{{ $value['ten_sp'] }}</h5></a>
							<p>{{ $value['ten_loaihinh'] }} {{ $value['loai_sp'] }}, {{ $value['dien_tich'] }} m2</p>
							<p>{{ $value['ten_tinhthanh'] }}, Giá: {{ $value['gia_tien'] = $value['gia_tien'] ?? 'Thoả thuận	' }}</p>
						</div>
					</div>
				@endforeach
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Sau</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Trước</span>
			</a>
		</div>
	</div>

	
	<br/>
	<!-- Main -->
	<main>
		<!-- Search Area -->
		<div class="container">
			<div class="search-area">
				<form action="{{ route('searching-product') }}" method="get">
					@csrf

					<div class="row m-auto">
						<div class="card mb-3" style="width: 100%;">
							<div class="card-header">
								<h5 class="header-card1 d-inline-block" >Tìm kiếm <kbd>căn hộ</kbd></h5>
								@if (session('search-failed'))
									<p class="text-uppercase m-auto d-inline-block px-1 py-1" style="background: #FFC302; border-radius: 5px; color: red; font-size: 14px; font-weight: bold;"><small style="font-weight: bold;">{{ session('search-failed') }}</small></p>
								@endif
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label for="loai_hinh">Loại hình:</label>
											<select class="custom-select mr-sm-2" id="loai_hinh" name="loai_hinh" >
												<option value="" disabled selected hidden>Loại hình ...</option>
												<option value="= 1">Bán</option>
												<option value="= 2">Cho thuê</option>
											</select>

											<label for="loai_sp" class="mt-2">Loại sản phẩm</label>
											<select class="custom-select mr-sm-2" id="loai_sp" name="loai_sp" >
												<option value="" disabled selected hidden>Loại sản phẩm ...</option>
												<option value="= 1">Căn hộ</option>
												<option value="= 2">Phòng trọ</option>
												<option value="= 3">Biệt thự</option>
												<option value="= 4">Nhà kho, xưởng</option>
												<option value="= 5">Nhà riêng</option>
												<option value="= 6">Văn phòng</option>
											</select>
										</div>
									</div>
									{{-- Trong controller , su dung switch case cho tung value --}}
									<div class="col-sm-3">
										<div class="form-group">
											<label for="gia_tien">Giá:</label>
											<select class="form-control input-md" id="gia_tien" name="gia_tien">
												<option value="" disabled selected hidden>Giá ...</option>
												<option value="is NULL">Thỏa thuận</option>
												<option value="< 500000000">< 500 triệu</option>
												<option value="BETWEEN 500000000 AND 800000000">500 - 800 triệu</option>
												<option value="BETWEEN 800000000 AND 1000000000">800 triệu - 1 tỷ</option>
												<option value="BETWEEN 1000000000 AND 2000000000">1 tỷ - 2 tỷ</option>
												<option value="BETWEEN 2000000000 AND 3000000000">2 tỷ - 3 tỷ</option>
												<option value="BETWEEN 3000000000 AND 4000000000">3 tỷ - 4 tỷ</option>
												<option value="BETWEEN 4000000000 AND 5000000000">4 tỷ - 5 tỷ</option>
												<option value="BETWEEN 5000000000 AND 6000000000">5 tỷ - 6 tỷ</option>
												<option value="BETWEEN 6000000000 AND 7000000000">6 tỷ - 7 tỷ</option>
												<option value="BETWEEN 7000000000 AND 8000000000">7 tỷ - 8 tỷ</option>
												<option value="> 8000000000">Trên 8 tỷ</option>
											</select>

											
											<label for="dien_tich" class="mt-2">Diện tích:</label>
											<select class="form-control input-sm" id="dien_tich" name="dien_tich">
												<option value="" disabled selected hidden>Diện tích ...</option>
												<option value="<= 30"> <=30 m2</option>
												<option value="BETWEEN 30 AND 50">30 - 50 m2</option>
												<option value="BETWEEN 50 AND 80">50 - 80 m2</option>
												<option value="BETWEEN 80 AND 100">80 - 100 m2</option>
												<option value="BETWEEN 100 AND 150">100 - 150 m2</option>
												<option value="BETWEEN 150 AND 200">150 - 200 m2</option>
												<option value="BETWEEN 200 AND 250">200 - 250 m2</option>
												<option value=">= 250">Trên 250 m2</option>
											</select>
											

										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group">
											<label for="khu_vuc">Khu vực:</label>
											<select name="khu_vuc" id="id_khuvuc" class="form-control input-lg " data-dependent="ten_tinhthanh" >
												<option value="" disabled selected hidden>Chọn Vùng miền</option>
												<option value="1">Miền Bắc</option>
												<option value="2">Miền Trung</option>
												<option value="3">Miền Nam</option>
											</select>
											
											<label for="khu_vuc" class="mt-2">Tỉnh thành:</label>
											<select name="tinh_thanh" id="id_tinhthanh" class="form-control input-lg " data-dependent="ten_quanhuyen">
												<option value="" disabled selected hidden> Chọn Tỉnh Thành</option>
											</select>
											
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group">
											<label for="khu_vuc">Quận huyện:</label>
											<select name="quan_huyen" id="id_quanhuyen" class="form-control input-lg">
												<option value="" disabled selected hidden>Chọn Quận/Huyện</option>
											</select>
											
											<label for="button" class="mt-2" style="color:white;">''</label>
											<button type="submit" class="btn btn-primary btn-block btnSearch" name="btnSearch" style="padding-left: 40px;">Tìm kiếm</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!--  Display arena -->

		<div class="container">

			<!-- First display area -->
			
			<div class="row">
				<div class="col-sm-6">
					<h5 class="cate-name">Căn hộ <kbd>cần bán</kbd></h5>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('selling-product') }}" title="Xem tất cả" class="a-button-all"><button type="button" class="btn btn-info btn-all">Xem tất cả</button></a>
				</div>
			</div>
			
			
			<div class="row mb-4">
				<div class="col-lg-12">
					<div class="card-deck">
						@foreach ($dataProduct['dataSale'] as $value)
							<div class="col-sm-4 mb-3">	
								<div class="card">
									<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><img class="card-img-top" 
										@if ($value['nguon_anh'] != null)
											src="{{ $value['nguon_anh'] }}" 
										@else
											src="{{ asset('upload/product/no-image.png') }}"
										@endif
									 alt="Card image cap" height="200"></a>
									<div class="card-body card-body-sp">
										<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><h6 class="card-title"><b><small class="font-weight-bold">{{ Str::words($value['ten_sp'],25,'...') }}</small></b></h6></a>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Khu vực </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_khuvuc'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Tỉnh </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_tinhthanh'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Quận/huyện </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_quanhuyen'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Loại hình </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_loaihinh'] }} {{ $value['loai_sp'] }}</small></p>
										</div><div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Giá </b></p>
											@if ($value['gia_tien'] != null)
												<p class="col-sm-6"><small>: {{ $value['gia_tien'] }}</small></p>
											@else
												<p class="col-sm-6"><small>: Thỏa thuận</small></p>
											@endif
										</div><div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Diện tích </b></p>
											<p class="col-sm-6"><small>: {{ $value['dien_tich'] }} m²</small></p>
										</div>
									</div>
									<div class="card-footer">
										<small class="text-muted">Đăng lúc : {{ $value['created_at'] }}</small>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>

			<!-- Second display area -->
			<!-- For rent -->
			<div class="row">
				<div class="col-sm-6">
					<h5 class="cate-name">Căn hộ <kbd>cho thuê</kbd></h5>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('renting-product') }}" title="Xem tất cả" class="a-button-all"><button type="button" class="btn btn-info btn-all">Xem tất cả</button></a>
				</div>
			</div>

			<div class="row mb-4">
				<div class="col-lg-12">
					<div class="card-deck">
						@foreach ($dataProduct['dataRent'] as $value)
						{{-- 	{{ dd(stripslashes($value['ten_sp'])) }} --}}

							<div class="col-sm-4 mb-3">	
								<div class="card">
									<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><img class="card-img-top" 
										@if ($value['nguon_anh'] != null)
											src="{{ $value['nguon_anh'] }}" 
										@else
											src="{{ asset('upload/product/no-image.png') }}"
										@endif
									 alt="Card image cap" height="200"></a>
									<div class="card-body card-body-sp">
										<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><h6 class="card-title"><b><small class="font-weight-bold">{{ Str::words($value['ten_sp'],10,'...') }}</small></b></h6></a>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Khu vực </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_khuvuc'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Tỉnh </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_tinhthanh'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Quận/huyện </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_quanhuyen'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Loại hình </b></p>
											<p class="col-sm-6"><small>: {{ $value['ten_loaihinh'] }} {{ $value['loai_sp'] }}</small></p>
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Giá </b></p>
											@if ($value['gia_tien'] != null)
												<p class="col-sm-6"><small>: {{ $value['gia_tien'] }}</small></p>
											@else
												<p class="col-sm-6"><small>: Thỏa thuận</small></p>
											@endif
										</div>
										<div class="row row-card">
											<p class="card-text h-detail1 col-sm-6"><b>Diện tích </b></p>
											<p class="col-sm-6"><small>: {{ $value['dien_tich'] }} m²</small></p>
										</div>
									</div>
									<div class="card-footer">
										<small class="text-muted">Đăng lúc : {{ $value['created_at'] }}</small>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>

		<!-- More information -->
		<div class="container-fluid more-info mb-4">
			<div class="container">
				<div class="col-lg-6" style="float:left">
					<div class="mt-4">
						<h2 class="spotlight1">Tiêu điểm căn hộ</h2>

						<p class="spotlight2">ASDSD</p>
						
						<div class="row">
							<div class="col-lg-5">
								<div class="card border-info mb-3">
									<div class="card-header"></div>
									<div class="card-body text-info">
										<h5 class="card-title"></h5>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="card border-info mb-3">
									<div class="card-header"></div>
									<div class="card-body text-info">
										<h5 class="card-title"></h5>
									</div>
								</div>
							</div>
						</div>

						<div class="row mb-5">
							<div class="col-lg-5">
								<div class="card border-info mb-3">
									<div class="card-header"></div>
									<div class="card-body text-info">
										<h5 class="card-title"></h5>
									</div>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="card border-info mb-3">
									<div class="card-header"></div>
									<div class="card-body text-info">
										<h5 class="card-title"></h5>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-lg-6" style="float:left">
					<div class="mt-2">
						<div class="carousel_2">
							<div id="carousel123" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carousel123" data-slide-to="0" class="active"></li>
									<li data-target="#carousel123" data-slide-to="1"></li>
									<li data-target="#carousel123" data-slide-to="2"></li>
									<li data-target="#carousel123" data-slide-to="3"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img src="{{ asset('img/anhnha01.jpg') }}" class="w-100" alt="Can't load this picture">
										<div class="carousel-caption">
											<a href="#"><h5>Căn hộ cầu giấy cần bán</h5></a>
											<p>Chi tiết xin liên hệ 0986922888</p>
										</div>
									</div>

									@foreach ($dataProduct['dataSale'] as $value)
									<div class="carousel-item">
										<img @if ($value['nguon_anh'] != null)
										src="{{ $value['nguon_anh'] }}" 
										@else
										src="{{ asset('upload/product/no-image.png') }}"
										@endif
										class="w-100" alt="Can't load this picture">
										<div class="carousel-caption">
											<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}"><h5>{{ $value['ten_sp'] }}</h5></a>
											<p>{{ $value['ten_loaihinh'] }}</p>
											<p>{{ $value['loai_sp'] }}</p>
										</div>
									</div>
									@endforeach

								</div>
								<a class="carousel-control-prev" href="#carousel123" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carousel123" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<!-- More information 2nd section -->
		<div class="container-fluid mb-4">
			<div class="container">
				<div class="row">
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Trang chủ</p>
						</div>
						</a>
					</div>
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Căn hộ bán</p>
						</div>
						</a>
					</div>
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Căn hộ cho thuê</p>
						</div>
						</a>
					</div>
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Tin Tức</p>
						</div>
						</a>
					</div>
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Về chúng tôi</p>
						</div>
						</a>
					</div>
					<div class="col-sm-2 imgbox">
						<a href="#"><img src="{{ asset('img/gradient-button.png') }}" alt="Error" class="img-inbox">
						<div class="img-caption">
							<p>Liên hệ</p>
						</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<!-- News -->
		<div class="container">
			
			<p><kbd>Tin tức</kbd> mới câp nhật</p>
			<div class="card-deck">
				@foreach ($dataProduct['dataNews'] as $value)
					<div class="card">
						<a href="{{ route('news.details',[ 'news_id' => $value['id'] ,'tieu_de' => Str::slug($value['tieu_de'], '-') ]) }}"><img class="card-img-top card-img-news" src="{{ $value['anh_dd'] }}" alt="Card image cap">
						<div class="card-body card-body-news">
							<h6 class="card-title card-title-news"><b>{{ $value['tieu_de'] }}</b></h6>
						</a>
							<p class="card-text card-shortdetail-news">{{ Str::words(strip_tags($value['noi_dung']), 25, '...') }}</p>

						</div>
						<div class="card-footer">
							<small class="text-muted">Đăng lúc: {{ $value['created_at'] }}</small>
						</div>
					</div>
				@endforeach
			</div>
		</div>

	</main>
	{{-- @endforeach	 --}}
	<br>
	<br>
</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function(){

			$('#id_khuvuc').change(function(){
				if($(this).val() != '')
				{
					var select = $(this).attr("id");
					var value = $(this).val();
					var dependent = $(this).data('dependent');
					var _token = $('input[name="_token"]').val();

					$.ajax({
						url:"{{ route('tinh_thanh.fetch') }}", //route de xu ly gui len va nhan du lieu ve
						method:"GET",
						data:{select:select, value:value, _token:_token, dependent:dependent}, //cac data se request len server
						dataType: 'json',
						
						success:function(response) // neu du lieu dung gui request len thanh cong
						{
							// console.log(dependent +' ' + select +' ' + value +' ' + _token);
							// alert(response);
							console.log(response);
							var len = 0;

							if(response['dataTT'] != null){
								len = response['dataTT'].length;
								if(len > 0){
						               // Read data and create <option >
						            for(var i=0; i<len; i++){

						               	var id_tt = response['dataTT'][i].id_tinhthanh;
						               	var ten_tt = response['dataTT'][i].ten_tinhthanh;

						               	var option = "<option value='"+id_tt+"'>"+ten_tt+"</option>"; 

						               	$("#id_tinhthanh").append(option); 
				               		}
				           		}
				       		}	

							// console.log(response['data']);
							// console.log(response['data'][1].id_tinhthanh);

							
						},
						error: function(xhr, status, error){ //neu du lieu duoc request that bai
							var errorMessage = xhr.status + ': ' + xhr.statusText
							console.log('Error - ' + errorMessage);
						}
						

					})

				}
			});

			$('#id_tinhthanh').change(function(){
				if($(this).val() != '')
				{
					var select = $(this).attr("id");
					var value = $(this).val();
					var dependent = $(this).data('dependent');
					var _token = $('input[name="_token"]').val();
					console.log(1 +' '+ dependent +' ' + select +' ' + value +' ' + _token);
					
					$.ajax({
						url:"{{ route('quan_huyen.fetch') }}",
						method:"GET",
						data:{select:select, value:value, _token:_token, dependent:dependent},
						dataType: 'json',
						
						success:function(response) // neu du lieu dung gui request len thanh cong
						{
							console.log(2 +' '+ dependent +' ' + select +' ' + value +' ' + _token);
							
							console.log(response);
							

							var len = 0;

							if(response['dataQH'] != null){
								len = response['dataQH'].length;
								console.log('yes');
							}

							console.log(response['dataQH']);
							console.log(response['dataQH'][1].id_quanhuyen);

							if(len > 0){
				               // Read data and create <option >
				               for(var i=0; i<len; i++){

				               	var id_qh = response['dataQH'][i].id_quanhuyen;
				               	var ten_qh = response['dataQH'][i].ten_quanhuyen;

				               	var option = "<option value='"+id_qh+"'>"+ten_qh+"</option>"; 

				               	$("#id_quanhuyen").append(option); 
				               }
				           }
						},
						error: function(xhr, status, error){ //neu du lieu duoc request that bai
							var errorMessage = xhr.status + ': ' + xhr.statusText
							console.log('Error - ' + errorMessage);
						}
						

					})

				}
			});

			

			$('#id_khuvuc').change(function(){
				$('#id_tinhthanh').empty().append('<option value="" disabled selected hidden>Chọn Tỉnh Thành</option>')
				$('#id_quanhuyen').empty().append('<option value="" disabled selected hidden>Chọn Quận Huyện</option>')
			});

			$('#id_tinhthanh').change(function(){
				$('#id_quanhuyen').empty().append('<option value="" disabled selected hidden>Chọn Quận Huyện</option>')
			});


		});
	</script>
@endpush