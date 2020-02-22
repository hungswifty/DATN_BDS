@extends('mainsite.base')

@section('content')


<form action="{{ route('upload-product-handle') }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
	
	@csrf

	<div class="container">
		<div class="row">
			<div class="m-auto">
				<div class="my-5" style="text-align: center;">
					<h4>ĐĂNG TIN RAO BÁN, CHO THUÊ NHÀ ĐẤT</h4>
					<p>(Quý vị nhập thông tin nhà đất cần bán hoặc cho thuê vào các mục dưới đây)</p>
				</div>
			</div>
		</div>
		<div class="container mb-3">
			<div class="row">
				<div class="m-auto">
					@if (session('success-upload'))
				<div class="row alert alert-success">
					<div class="col-md-12 text-center">
			        	<h5 class="text-uppercase">{{ session('success-upload') }}</h5>
					</div>
			    </div>
			@elseif(session('failed-upload'))
				<div class="row alert alert-danger text-center">
					<h6 class="text-uppercase" style="margin: 10px auto;">{{ session('failed-upload') }}</h6>
				</div>
			@endif
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="m-auto box-surround">
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
							<input type="text" class="form-control iptext-upload-sp" id="tieude" placeholder="Nhập vào nội dung tiêu đề bài đăng" aria-describedby="tieudeHelp" name="ten_sp" required>
							<small id="tieudeHelp" class="form-text text-muted">Tiêu đề cần có ít nhất 30 kí tự, tối đa là 99 kí tự</small>
						</div>
						<div class="col-sm-2">
							<h6 class="pull-right my-3" id="count_message" style="font-size: 12px;"></h6>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-6">
							<div class="row">
								<label for="loai_hinh" class="col-sm-4 col-form-label label-upload-sp">Loại hình(*):</label>
								<div class="col-sm-7">
									<select class="custom-select mr-sm-2" id="loai_hinh" name="loai_hinh" required>
										<option value="" disabled selected hidden>Loại hình...</option>
										<option value="1">Bán</option>
										<option value="2">Cho thuê</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label for="loai_sp" class="col-sm-5 col-form-label label-upload-sp">Loại sản phẩm(*):</label>
								<div class="col-sm-7">
									<select class="custom-select mr-sm-2" id="loai_sp" name="loai_sp" required>
										<option value="" disabled selected hidden>Loại sản phẩm...</option>
										<option value="1">Căn hộ</option>
										<option value="2">Phòng trọ</option>
										<option value="3">Biệt thự</option>
										<option value="4">Nhà kho, xưởng</option>
										<option value="5">Nhà riêng</option>
										<option value="6">Văn phòng</option>
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
									<select name="khu_vuc" id="id_khuvuc" class="form-control input-lg " data-dependent="ten_tinhthanh" required>
										<option value="" disabled selected hidden>Chọn Vùng miền</option>
										@foreach($data as $khuvuc)
										<option value="{{ $khuvuc->id }}">{{ $khuvuc->ten_khuvuc }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label for="tinh_thanh" class="col-sm-5 col-form-label label-upload-sp">Tỉnh thành(*):</label>
								<div class="col-sm-7">
									<select name="tinh_thanh" id="id_tinhthanh" class="form-control input-lg " data-dependent="ten_quanhuyen" required>
										<option value="" disabled selected hidden> Chọn Tỉnh Thành</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<div class="row">
								<label for="id_quanhuyen" class="col-sm-4 col-form-label label-upload-sp">Quận/huyện(*):</label>
								<div class="col-sm-7">
									<select name="quan_huyen" id="id_quanhuyen" class="form-control input-lg" required>
										<option value="" disabled selected hidden>Chọn Quận/Huyện</option>
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
									<input type="text" class="form-control" id="gia_tien" placeholder="Giá sản phẩm" name="gia_tien" aria-describedby="tieudeHelp1" style="margin: 0; width: 100%;">
									<small id="tieudeHelp1" class="form-text text-muted">Nếu Giá cả thỏa thuận, vui lòng bỏ trống</small>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label for="dien_tich" class="col-sm-5 col-form-label label-upload-sp">Diện tích(*):</label>
								<div class="col-sm-5">
									
									<input type="text" class="form-control numberOnly" id="dien_tich" name="dien_tich" style="margin: 0; width: 100%;" required>
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
						<input type="text" class="form-control iptext-upload-sp" id="diachi_chitiet" name="diachi_chitiet" required>
					</div>
				</div>


			</div>
		</div>
		
		<div class="row mt-3">
			<div class="m-auto box-surround">
				<div class="form-box">
					<div class="d-block text-center my-2 mb-4">
						<h3>MÔ TẢ SƠ LƯỢC</h3>
					</div>
					<div class="form-group row">
						<label for="mota_soluoc" class="col-sm-2 col-form-label label-upload-sp">(*)Tối đa chỉ 3000 kí tự</label>
						<div class="col-sm-7">
							<textarea class="form-control iptext-upload-sp" id="mota_soluoc" name="mota_soluoc" rows="9" required></textarea>
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
			<div class="m-auto box-surround">
				<div class="form-box">
					<div class="d-block text-center my-2 mb-4">
						<h3>THÔNG TIN KHÁC</h3>
					</div>

					<div class="form-group row">
						<div class="col-sm-6">
							<div class="row">
								<label for="so_tang" class="col-sm-4 col-form-label label-upload-sp">Số tầng:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control numberOnly" id="so_tang"  name="so_tang" style="margin: 0; width: 100%;">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label for="so_phongan" class="col-sm-5 col-form-label label-upload-sp">Số phòng ăn:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control numberOnly" id="so_phongan"  name="so_phongan" style="margin: 0; width: 100%;">
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-6">
							<div class="row">
								<label for="so_phongngu" class="col-sm-4 col-form-label label-upload-sp">Số phòng ngủ:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control numberOnly" id="so_phongngu"  name="so_phongngu" style="margin: 0; width: 100%;">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<label for="so_nhavesinh" class="col-sm-5 col-form-label label-upload-sp">Số toilet:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control numberOnly" id="so_nhavesinh"  name="so_nhavesinh" style="margin: 0; width: 100%;">
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
		<div class="row mt-3">
			<div class="m-auto box-surround">
				<div class="form-box">
					<div class="d-block text-center my-2 mb-4">
						<h3>HÌNH ẢNH</h3>
					</div>
					<p><small>Chọn tối đa 8 ảnh, mỗi ảnh tối đa 2MB</small></p>
					<p><small>Tin rao có ảnh sẽ được xem nhiều hơn gấp 10 lần và được nhiều người gọi gấp 5 lần so với tin rao không có ảnh. Hãy đăng ảnh để được giao dịch nhanh chóng!</small></p>
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

{{-- 		<div class="row mt-3">
			<div class="m-auto box-surround">
				<div class="form-box">
					<div class="d-block text-center my-2 mb-4">
						<h3>LIÊN HỆ</h3>
					</div>

				</div>
			</div>
		</div> --}}

		<div class="row mt-3">
			<div class="m-auto box-surround text-center">
				<button type="submit" name="btnDangTin" class="btn btn-success" style="padding: 10px 50px;">Đăng tin</button>
			</div>
		</div>	

	</div>	
</div>
</form>
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