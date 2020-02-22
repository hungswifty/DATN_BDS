@extends('mainsite.base')

@section('content')

@foreach ($data['dataUser'] as $key => $value)
	{{-- expr --}}
@endforeach
<div class="container" style="min-height:400px;">
	<div class="row pt-3">
		<div class=" col-sm-3">
			<div class="card" style="width: 100%;">
				<div class="card-header">
					<h5 class="header-card1"><kbd>Trang cá nhân</kbd></h5>
				</div>
				<div class="card-body" style="padding: 0 0;">
					<div class="user-avatar text-center py-5">
						{{-- if anh dai dien = null, hien anh mac dinh , else hien anh trong fdb --}}
						@if ($value['anhdaidien'])
							<img src="../../{{ $value['anhdaidien'] }}" alt="Ảnh đại diện" width="130" height="130">
						@else
							<img src="{{ asset('upload/user/person-icon.png') }}" alt="Ảnh đại diện" width="130" height="130">
						@endif
						
					</div>
				</div>
				<div class="card-body" style="padding: 0 0;">
					<div class="vertical-menu">
						<a class="active" disabled>Quản lý thông tin cá nhân</a>
						<a href="{{ route('user.change-info') }}">Thay đổi thông tin cá nhân</a>
						<a href="{{ route('user.change-pw') }}">Thay đổi mật khẩu</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Quản lý tin rao</a>
						<a href="{{ route('user.user-product') }}">Quản lý tin rao bán/cho thuê</a>
						<a href="{{ route('upload-product') }}">Đăng tin rao bán, cho thuê</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Tiện ích</a>
						<a href="{{ route('user.mailbox') }}">Hộp tin nhắn</a>
					</div>

					<div class="vertical-menu">
						<a class="active" disabled>Khác</a>
						<a href="#">Hướng dẫn sử dụng</a>
					</div>
				</div>
			</div>
			
		</div>




		{{-- Content --}}
		@foreach ($data['dataProduct'] as $key => $value)
			{{-- {{ dd($value) }} --}}
		@endforeach

		<div class="col-sm-9">
			<div class="card" style="width: 100%;">
				<div class="card-body" style="padding: 0 0;">
					<div class="card-header">
						<h5 class="header-card1"><kbd>Sửa bài viết</kbd></h5>
					</div>
					<div class="card-body">
						<form action="{{ route('user.edit-productHandle',[ 'id_sanpham' => $value['id'] ]) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
							@csrf
							<div class="container mb-3">
								<div class="row">
									<div class="m-auto">
										@if (session('success-editProduct'))
										<div class="row alert alert-success">
											<div class="col-md-12 text-center">
												<h5 class="text-uppercase">{{ session('success-editProduct') }}</h5>
											</div>
										</div>
										@elseif(session('failed-editProduct'))
										<div class="row alert alert-danger text-center">
											<h6 class="text-uppercase" style="margin: 10px auto;">{{ session('failed-editProduct') }}</h6>
										</div>
										@endif
									</div>
								</div>
							</div>
						<div class="row">
							<div class="m-auto box-surround" style="width:100%">
								<div class="form-box">
									<div class="row text-center">
										@if ($errors->any())
										<div class="alert alert-danger w-100">
											<ul>
												@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
										@endif
									</div>
									<div class="d-block text-center my-2 mb-4">
										<h3>THÔNG TIN CƠ BẢN</h3>
									</div>
									<div class="form-group row">
										<label for="tieude" class="col-sm-2 col-form-label label-upload-sp">Tiêu đề(*):</label>
										<div class="col-sm-8">
											<input type="text" class="form-control iptext-upload-sp" id="tieude" placeholder="Nhập vào nội dung tiêu đề bài đăng" aria-describedby="tieudeHelp" name="ten_sp"value="{{ $value['ten_sp'] }}">
											<small id="tieudeHelp" class="form-text text-muted">Tiêu đề cần có ít nhất 30 kí tự, tối đa là 99 kí tự</small>
										</div>
										<div class="col-sm-2">
											<h6 class="pull-right my-3" id="count_message" style="font-size: 12px;"></h6>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="loai_hinh" class="col-sm-4 col-form-label label-upload-sp">Tình trạng:</label>
												<div class="col-sm-7">
													<select class="custom-select mr-sm-2" id="tinh_trang" name="tinh_trang" required>
														<option value="" disabled selected hidden>Tình trạng...</option>
														@if ($value['tinh_trang'] == 0)
															<option value="0" selected="selected">Hiển thị bài đăng</option>
															<option value="1">Ẩn bài đăng</option>
														@else
															<option value="0">Hiển thị bài đăng</option>
															<option value="1" selected="selected">Ẩn bài đăng</option>
														@endif
													</select>
												</div>
											</div>
										</div>
									</div>


									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="loai_hinh" class="col-sm-4 col-form-label label-upload-sp">Loại hình(*):</label>
												<div class="col-sm-7">
													<select class="custom-select mr-sm-2" id="loai_hinh" name="loai_hinh" required>
														<option value="" disabled selected hidden>Loại hình...</option>
														@if ($value['id_loaihinh'] == 1)
															<option value="1" selected="selected">Bán</option>
															<option value="2">Cho thuê</option>
														@else
															<option value="1">Bán</option>
															<option value="2" selected="selected">Cho thuê</option>
														@endif
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="loai_sp" class="col-sm-5 col-form-label label-upload-sp">Loại sản phẩm(*):</label>
												<div class="col-sm-7">
													<select class="custom-select mr-sm-2" id="loai_sp" name="loai_sp" required>
														@if ($value['id_loaisp'] == 1)
															<option value="1" selected="selected">Căn hộ</option>
															<option value="2">Phòng trọ</option>
															<option value="3">Biệt thự</option>
															<option value="4">Nhà kho, xưởng</option>
															<option value="5">Nhà riêng</option>
															<option value="6">Văn phòng</option>
														@elseif ($value['id_loaisp'] == 2)
															<option value="1">Căn hộ</option>
															<option value="2" selected="selected">Phòng trọ</option>
															<option value="3">Biệt thự</option>
															<option value="4">Nhà kho, xưởng</option>
															<option value="5">Nhà riêng</option>
															<option value="6">Văn phòng</option>
														@elseif ($value['id_loaisp'] == 3)
															<option value="1">Căn hộ</option>
															<option value="2">Phòng trọ</option>
															<option value="3" selected="selected">Biệt thự</option>
															<option value="4">Nhà kho, xưởng</option>
															<option value="5">Nhà riêng</option>
															<option value="6">Văn phòng</option>
														@elseif ($value['id_loaisp'] == 4)
															<option value="1">Căn hộ</option>
															<option value="2">Phòng trọ</option>
															<option value="3">Biệt thự</option>
															<option value="4" selected="selected">Nhà kho, xưởng</option>
															<option value="5">Nhà riêng</option>
															<option value="6">Văn phòng</option>
														@elseif ($value['id_loaisp'] == 5)
															<option value="1">Căn hộ</option>
															<option value="2">Phòng trọ</option>
															<option value="3">Biệt thự</option>
															<option value="4">Nhà kho, xưởng</option>
															<option value="5" selected="selected">Nhà riêng</option>
															<option value="6">Văn phòng</option>
														@elseif ($value['id_loaisp'] == 6)
															<option value="1">Căn hộ</option>
															<option value="2">Phòng trọ</option>
															<option value="3">Biệt thự</option>
															<option value="4">Nhà kho, xưởng</option>
															<option value="5">Nhà riêng</option>
															<option value="6" selected="selected">Văn phòng</option>
														@endif
													</select>
												</div>
											</div>
										</div>
									</div>


									<div class="form-group row">

										<div class="col-sm-6">
											<div class="row">
												<label for="khu_vuc" class="col-sm-4 col-form-label label-upload-sp">Khu vực(*):</label>
												<div class="col-sm-7">
													<select name="khu_vuc" id="id_khuvuc" class="form-control input-lg " data-dependent="ten_tinhthanh" aria-describedby="tieudeHelp2">
														<option value="null"  selected hidden>Chọn Vùng miền</option>
														<option value="1">Miền Bắc</option>
														<option value="2">Miền Trung</option>
														<option value="3">Miền Nam</option>
													</select>
													<small id="tieudeHelp2 " class="form-text text-muted">Nếu không thay đổi khu vực, tỉnh thành, quận/huyện vui lòng bỏ qua</small>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="id_tinhthanh" class="col-sm-5 col-form-label label-upload-sp">Tỉnh thành(*):</label>
												<div class="col-sm-7">
													<select name="tinh_thanh" id="id_tinhthanh" class="form-control input-lg " data-dependent="ten_quanhuyen">
														<option value="null"  selected hidden> Chọn Tỉnh Thành</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="id_quanhuyen" class="col-sm-4 col-form-label label-upload-sp">Quận huyện(*):</label>
												<div class="col-sm-7">
													<select name="quan_huyen" id="id_quanhuyen" class="form-control input-lg">
														<option value="null"  selected hidden>Chọn Quận/Huyện</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="gia_tien" class="col-sm-4 col-form-label label-upload-sp">Giá tiền:</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="gia_tien" placeholder="Giá sản phẩm" name="gia_tien" aria-describedby="tieudeHelp1" style="margin: 0; width: 100%;" value="{{ $value['gia_tien'] }}">
													<small id="tieudeHelp1" class="form-text text-muted">Nếu Giá cả thỏa thuận, vui lòng bỏ trống</small>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="dien_tich" class="col-sm-5 col-form-label label-upload-sp">Diện tích:</label>
												<div class="col-sm-5">
													<input type="text" class="form-control numberOnly" id="dien_tich" name="dien_tich" style="margin: 0; width: 100%;" value="{{ $value['dien_tich'] }}">
												</div>
												<div class="col-sm-2">
													<div class="input-group-prepend">
														<div class="input-group-text metvuong" >m2</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="diachi_chitiet" class="col-sm-2 col-form-label label-upload-sp">Địa chỉ(*):</label>
									<div class="col-sm-8">
										<input type="text" class="form-control iptext-upload-sp" id="diachi_chitiet" name="diachi_chitiet" value="{{ $value['diachi_chitiet'] }}">
									</div>
								</div>


							</div>
						</div>

						<div class="row mt-3">
							<div class="m-auto box-surround" style="width:100%">
								<div class="form-box">
									<div class="d-block text-center my-2 mb-4">
										<h3>MÔ TẢ SƠ LƯỢC</h3>
									</div>
									<div class="form-group row">
										<label for="mota_soluoc" class="col-sm-2 col-form-label label-upload-sp">(*)Tối đa chỉ 3000 kí tự</label>
										<div class="col-sm-7">
											<textarea class="form-control iptext-upload-sp" id="mota_soluoc" name="mota_soluoc" rows="9">{{ $value['mota_soluoc'] }}</textarea>
										</div>
										<div class="col-sm-3">
											<h6 class="pull-right my-3" id="count_message_2" style="font-size: 12px; "></h6>
											<p><small>Giới thiệu chung về bất động sản của bạn. Ví dụ: Khu nhà có vị trí thuận lợi: Gần công viên, gần trường học ... Tổng diện tích 52m2, đường đi ô tô vào tận cửa.</small></p>
											<p class="text-danger"><small>Lưu ý: tin rao chỉ để mệnh giá tiền Việt Nam Đồng.</small></p>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="row mt-3">
							<div class="m-auto box-surround" style="width:100%">
								<div class="form-box">
									<div class="d-block text-center my-2 mb-4">
										<h3>THÔNG TIN KHÁC</h3>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="so_tang" class="col-sm-4 col-form-label label-upload-sp">Số tầng:</label>
												<div class="col-sm-7">
													<input type="text" class="form-control numberOnly" id="so_tang"  name="so_tang" style="margin: 0; width: 100%;" value="{{ $value['so_tang'] }}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="so_phongan" class="col-sm-5 col-form-label label-upload-sp">Số phòng ăn:</label>
												<div class="col-sm-7">
													<input type="text" class="form-control numberOnly" id="so_phongan"  name="so_phongan" style="margin: 0; width: 100%;" value="{{ $value['so_phongan'] }}">
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
											<div class="row">
												<label for="so_phongngu" class="col-sm-4 col-form-label label-upload-sp">Số phòng ngủ:</label>
												<div class="col-sm-7">
													<input type="text" class="form-control numberOnly" id="so_phongngu"  name="so_phongngu" style="margin: 0; width: 100%;" value="{{ $value['so_phongngu'] }}">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<label for="so_nhavesinh" class="col-sm-5 col-form-label label-upload-sp">Số toilet:</label>
												<div class="col-sm-7">
													<input type="text" class="form-control numberOnly" id="so_nhavesinh"  name="so_nhavesinh" style="margin: 0; width: 100%;" value="{{ $value['so_nhavesinh'] }}">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="m-auto box-surround" style="width:100%;">
								<div class="form-box">
									<div class="d-block text-center my-2 mb-4">
										<h3>CHỌN HÌNH ẢNH MỚI</h3>
									</div>
									<div class="row mb-4">
										<h6 class="m-auto">Ảnh hiện tại</h6>
									</div>
									<div class="row mb-4 text-center">
										<div class="m-auto">
										@foreach ($data['oldImage'] as $key => $value)
											<img src="../../{{ $value->nguon_anh }}" alt="Ảnh {{ $key }}" width="150" height="150">
										@endforeach
									</div>
								</div>
									<p><small>Chọn tối đa 8 ảnh, mỗi ảnh tối đa 2MB</small></p>
									<p><small>Hình ảnh cũ sẽ được xóa và thay vào đó bằng những hình ảnh mới </small></p>
									<div class="notice mb-3">
										<p><small></small></p>
									</div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="anh_sp[]" multiple="multiple">
										<label class="custom-file-label" for="customFile">Chọn ảnh</label>
									</div>
									<div class="gallery my-2">				
									</div>

								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="m-auto text-center">
								<button type="submit" name="btnDangTin" class="btn btn-success" style="padding: 10px 50px;">Sửa tin</button>
							</div>
						</div>	
					</div>
				</div>
			</form>
			</div>
			
		</div>
	</div>
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