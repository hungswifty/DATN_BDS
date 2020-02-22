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

	<div >
		{{-- Khong nhap --}}
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

		{{-- Thong bao thanh cong/that bai --}}
		@if (session('ADsuccess-addproduct'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h5 class="text-uppercase">{{ session('ADsuccess-addproduct') }}</h5>
			</div>
		</div>
		@elseif (session('ADfailed-addproduct'))
		<div class="row alert alert-success text-center">
			<h5 class="text-uppercase">{{ session('ADfailed-addproduct') }}</h5>
		</div>
		@endif

		<div class="row">
			
			<div class="container">
				<header class="card-header">
					<h4 class="card-title mt-2 text-info">Thêm mới sản phẩm</h4>
			</header>
			<article class="card-body">
				<form action="{{ route('admin.add-product-handle') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}

					<div class="form-group">
						<div class="d-block text-center my-2 mb-4">
							<h3>THÔNG TIN CƠ BẢN</h3>
						</div>
						<div class="form-group row">
							<label for="tieude" class="col-sm-2 col-form-label label-upload-sp">Tiêu đề(*):</label>
							<div class="col-sm-8">
								<input type="text" class="form-control iptext-upload-sp" id="tieude" placeholder="Nhập vào nội dung tiêu đề bài đăng" aria-describedby="tieudeHelp" name="ten_sp">
								<small id="tieudeHelp" class="form-text text-muted">Tiêu đề cần có ít nhất 30 kí tự, tối đa là 99 kí tự</small>
							</div>
							<div class="col-sm-2">
								<h6 class="pull-right my-3" id="count_message" style="font-size: 12px;"></h6>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-6">
								<div class="row">
									<label for="tinh_trang" class="col-sm-4 col-form-label label-upload-sp">Tình trạng(*):</label>
									<div class="col-sm-7">
										<select class="custom-select mr-sm-2" id="tinh_trang" name="tinh_trang" required>
											<option value="" disabled selected hidden>Tình trạng...</option>
											<option value="0">Hiển thị bài đăng</option>
											<option value="1">Ẩn bài đăng</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row">
									<label for="trang_thai" class="col-sm-5 col-form-label label-upload-sp">Trạng thái(*):</label>
									<div class="col-sm-7">
										<select class="custom-select mr-sm-2" id="trang_thai" name="trang_thai" required>
											<option value="" disabled selected hidden>Trạng thái...</option>
											<option value="1">Duyệt</option>
											<option value="0">Chưa duyệt</option>
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
												@foreach ($data['dataLoaiSP'] as $loai)
													<option value="{{ $loai->id }}">{{ $loai->loai_sp }}</option>
												@endforeach
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
										<select name="khu_vuc" id="id_khuvuc" class="form-control input-lg " data-dependent="ten_tinhthanh" >
											<option value="" disabled selected hidden>Chọn Vùng miền</option>
											@foreach($data['dataKhuVuc'] as $khuvuc)
												<option value="{{ $khuvuc->id }}">{{ $khuvuc->ten_khuvuc }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row">
									<label for="id_tinhthanh" class="col-sm-5 col-form-label label-upload-sp">Tỉnh thành(*):</label>
									<div class="col-sm-7">
										<select name="tinh_thanh" id="id_tinhthanh" class="form-control input-lg " data-dependent="ten_quanhuyen">
											<option value="" disabled selected hidden> Chọn Tỉnh Thành</option>
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
									<label for="dien_tich" class="col-sm-5 col-form-label label-upload-sp">Diện tích:</label>
									<div class="col-sm-5">

										<input type="text" class="form-control numberOnly" id="dien_tich" name="dien_tich" style="margin: 0; width: 100%;">
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
							<input type="text" class="form-control iptext-upload-sp" id="diachi_chitiet" name="diachi_chitiet">
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="row mt-3">
							<div class="m-auto box-surround">
								<div class="form-box">
									<div class="d-block text-center my-2 mb-4">
										<h3>MÔ TẢ SƠ LƯỢC</h3>
									</div>
									<div class="form-group row">
										<label for="mota_soluoc" class="col-sm-2 col-form-label label-upload-sp">(*)Tối đa chỉ 3000 kí tự</label>
										<div class="col-sm-7">
											<textarea class="form-control iptext-upload-sp" id="mota_soluoc" name="mota_soluoc" rows="9"></textarea>
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
					</div>

					<hr>

					<div class="form-group">
						<div class="row mt-3 w-100">
							<div class="box-surround w-100">
								<div class="form-box col-sm-12">
									<div class=" text-center my-2 mb-4 m-auto">
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

						<hr>

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
					</div>



					<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-lg btn-block">Thêm mới</button>
				</form>
			</article>
			</div>
		</div>

	</div>

</div>
</div>
@endsection

@push('script')
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