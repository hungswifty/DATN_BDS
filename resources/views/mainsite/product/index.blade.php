@extends('mainsite.base')

@section('content')

<div class="container">
	<div class="container-fluid">
		@foreach ($data['productDetail'] as $value)
		@endforeach

		<div class="row pt-2">
{{-- 			<form action="#" method="get" accept-charset="utf-8">
				@csrf --}}

				<div class="form-group d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0 py-2">
					<a href="{{ route('user.messSender',[ 'sanpham_id' => $value['id'] ]) }}" title="Gửi tin nhắn"><button type="button" class="btn btn-info">Gửi tin nhắn</button></a>
					
					<button type="button" id="btnPH" class="btn btn-warning" data-toggle="modal" data-target="#phan_hoi" data-phanhoi="{{ $value['id'] }}">Phản hồi</button>

					<div class="modal fade" id="phan_hoi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Phản hồi</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form id="form_phanhoi" action="{{ route('send-report') }}" method="POST" enctype="multipart/form-data">
										@if (!session()->has('tentaikhoan'))
											<div class="form-group">
												<label for="email" class="col-form-label">Email: </label>
												<input type="email" class="form-control w-100 text-center required" id="email" name="email" required>
											</div>
											<div class="form-group">
												<label for="so_dt" class="col-form-label">Số điện thoại: </label>
												<input type="text" class="form-control w-100 required" id="so_dt" name="so_dt" required> 
											</div>
											<div class="form-group">
												<label for="noi_dung" class="col-form-label">Nội dung phản hồi: </label>
												<textarea class="form-control w-100 required" id="noi_dung " name="noi_dung" required></textarea>
											</div>
										@else
											<div class="form-group">
												<label for="email" class="col-form-label">Email: </label>
												<input type="email" class="form-control text-center w-100 required" id="email" name="email" required value="{{ session()->get('email') }}">
											</div>
											<div class="form-group">
												<label for="so_dt" class="col-form-label">Số điện thoại: </label>
												<input type="text" class="form-control w-100 required" id="so_dt" name="so_dt" required value="{{ session()->get('so_dt') }}"> 
											</div>
										@endif
										
										<div class="form-group">
											<label for="noi_dung" class="col-form-label">Nội dung phản hồi: </label>
											<textarea class="form-control w-100 required" id="noi_dung " name="noi_dung" required></textarea>
										</div>
									</form>
									{{ csrf_field() }}
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
									<button type="button" id="submitButton" class="btn btn-primary">Gửi phản hồi</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			{{-- </form> --}}
		</div>

		<div class="row">
			<div class="card mb-3 mt-1" style="width: 100%;">
				

					<div class="card-header">
						<h5 class="header-card1">{{ $value['ten_sp'] }}</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-2">
								<p><b class="body-detail">Tỉnh thành:</b></p>
							</div>
							<div class="col-sm-8">
								<p><small>{{ $value['ten_tinhthanh'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<p><b class="body-detail">Quận/Huyện: </b></p>
							</div>
							<div class="col-sm-8">
								<p><small>{{ $value['ten_quanhuyen'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2">
								<p><b class="body-detail">Giá: </b></p>
							</div>
							<div class="col-sm-8">
								@if ($value['gia_tien'] != null)
									<p><small id="menh_gia" class="menhgia">{{ $value['gia_tien'] }}</small> VND</p>
								@else
									<p><small>Thỏa thuận</small>
								@endif
							</div>
								
						</div>
						<div class="row">
							<div class="col-sm-2">
								<p><b class="body-detail">Diện tích:</b></p>
							</div>
							<div class="col-sm-8">
								<p><small>{{ $value['dien_tich'] }} m²</small></p>
							</div>			
						</div>
					</div>

				
			</div>
		</div>

		<div class="row">
			<div class="card mb-3" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1">Thông tin chung</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<p><b class="body-detail">Thông tin mô tả</b></p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="body-detail">{{ str_replace('\n', '</br>', $value['mota_soluoc']) }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Slide anh --}}
		<div class="slide_anh">
			<div class="row mb-3">
				<div class="card" style="width:100%;">
					<div class="card-header">
						<h5 class="header-card1">Xem Ảnh</h5>
					</div>
					<div class="card-body">
						<div class="container_anh">
							<!-- Thumbnail images -->
							<div class="row">
								<div class="container">
									@foreach ($data['productImages'] as $key => $value)
										<div class="column">
											<img class="demo cursor" src="{{ asset($value['nguon_anh']) }}" style="width:100%" height="100" onclick="currentSlide({{ $key+1 }})" alt="Ảnh số {{ $key+1 }}">
										</div>
									@endforeach
								</div>				
							</div>

							<!-- Full-width images with number text -->
							@foreach ($data['productImages'] as $key => $value)
								<div class="mySlides">
									<div class="numbertext">{{ $key+1 }} / {{ count($data['productImages']) }}</div>
									<img src="{{ asset($value['nguon_anh']) }}" style="width:100%" height="500">
								</div>
							@endforeach

							<!-- Next and previous buttons -->
							<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
							<a class="next" onclick="plusSlides(1)">&#10095;</a>

							<!-- Image text -->
							<div class="caption-container">
								<p id="caption"></p>
							</div>

						</div>
					</div>

				</div>

				<!-- Container for the image gallery -->

			</div>
		</div>
		{{-- End slide --}}

		<div class="row">
			<div class="col-sm-7" style="padding-left:0;">
				<div class="card mb-3" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1">Đặc điểm</h5>
				</div>
				<div class="card-body">
					@foreach ($data['productDetail'] as $value)
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Loại tin</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>{{ $value['ten_loaihinh'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Địa chỉ</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>{{ $value['diachi_chitiet'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Số tầng</b></p>
							</div>
							
							<div class="col-sm-8">
								@if ($value['so_tang'] != null)
									<p><small>{{ $value['so_tang'] }}</small></p>
								@else
									<p><small>Chưa có thông tin</small></p>
								@endif
								
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Số phòng ngủ</b></p>
							</div>
							
							<div class="col-sm-8">
								@if ($value['so_phongngu'] != null)
									<p><small>{{ $value['so_phongngu'] }}</small></p>
								@else
									<p><small>Chưa có thông tin</small></p>
								@endif
							</div>
						</div>
					@endforeach
				</div>
			</div>
			</div>
			<div class="col-sm-5" style="padding-right: 0;">
				<div class="card mb-3" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1">Liên hệ</h5>
				</div>
				<div class="card-body">
					@foreach ($data['dataUser'] as $value)
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Tên liên lạc</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>{{ $value['hoten'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Mobile</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>{{ $value['so_dt'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Email</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>{{ $value['email'] }}</small></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<p class="color-blue"><b>Liên lạc khác</b></p>
							</div>
							
							<div class="col-sm-8">
								<p><small>Không có</small></p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			</div>
		</div>

		<div class="row">
			<p><small>Mọi thông tin liên quan tới tin rao này là do người đăng tin đăng tải và chịu trách nhiệm. Chúng tôi luôn cố gắng để có chất lượng thông tin tốt nhất, nhưng chúng tôi không đảm bảo và không chịu trách nhiệm về bất kỳ nội dung nào liên quan tới tin rao này. Nếu quý vị phát hiện có sai sót hay vấn đề gì xin hãy thông báo cho chúng tôi.</small></p>
		</div>

		{{--  <div>
			Phần này hiển thị bài viết có cùng tỉnh thành 
			data['dataProvince']
		</div>   --}}


		<div class="row">
			<div class="card mb-3" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1">Tin đăng cùng tỉnh thành</h5>
				</div>
				<div class="card-body">
					@foreach ($data['dataProvince'] as $key => $value)
						<div class="media">
							<a href="{{ route('product-detail',[ 'product_id' => $value['id'] ,'product_title' => Str::slug($value['ten_sp'], '-') ]) }}" title="{{ $value['ten_sp'] }}">
								<img class="align-self-start mr-3" src="../../{{ $value['nguon_anh'] }}" width="130" height="130" alt="Hinh anh tin tuc">
								<div class="media-body">
								    <h5 class="mt-0">{{ $value['ten_sp'] }}</h5>
								    <p class="short-content">{{ Str::words(strip_tags($value['mota_soluoc']), 60, '...') }}</p>
							</a>
							</div>
						</div></br>
					@endforeach
				</div>
			</div>
		</div>

		</div>
	</div>
</div>


@endsection

@push('scripts')
	<script>
		$(document).ready(function () {
			$(".img-user").attr("src", function(i, val) {
				  return '../../../'+val; //i == index, val == original attribute, the id
			});

			$("#form_phanhoi").on("submit", function(e) {
				// console.log('abc');
				var postData = JSON.stringify($(this).serializeArray()); //bien du lieu serializeArray thanh string kieu json object
				var formURL = $(this).attr("action");
				var _token = $('input[name="_token"]').val();
				var id_sanpham = $('#btnPH').data('phanhoi');
				$.ajax({
					url: formURL,
					type: "POST",
					data: {postData:postData, _token:_token, id_sanpham:id_sanpham},
					success: function(result) {
						// console.log(result);
						$("#form_phanhoi").find("input,textarea,label").remove();
						$("#submitButton").remove();
						$("#form_phanhoi").append('<h6 style="color:#022BA6;"><b>Cảm ơn bạn đã đóng góp !</b></h6>');
					},
					error: function(jqXHR, status, error) {
						console.log(status + ": " + error);
					}
				});
				e.preventDefault();
				
			});

			//button to submit form
			$("#submitButton").on('click', function(e) {
				// var postData = $('#form_phanhoi').serializeArray();
				// var _token = $('input[name="_token"]').val();
				// var id_sanpham = $('#btnPH').data('phanhoi');
				// console.log(postData);
				if($checkMail() == false){
					alert('Địa chỉ email không hợp lệ!');
				} else{
					if ($checkNull() == false){
						alert('Vui lòng nhập đầy đủ các thông tin!');
						e.preventDefault();
					} else {
					// console.log('true');
						$("#form_phanhoi").submit();
					}
				}
    		});
		


		});

		$checkNull = function check_required_inputs() {
			$check = true;
			
			$('.required').each(function(){
				if( $(this).val() == "" ){
						// console.log($(this).val());
					$check = false;
				}
			});

			return $check;
		};

		$checkMail = function check_mail(){
			var mailInput = $('#email').val();
			var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			var check = re.test(mailInput);
			
			if(!check){
				return false;
			}
			// console.log(mailInput);
		};
	</script>
@endpush