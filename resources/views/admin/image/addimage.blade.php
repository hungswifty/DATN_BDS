@extends('admin.base')

@section('content')
<div class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Quản lý hình ảnh</a>
		</li>
		<li class="breadcrumb-item active">Thêm hình ảnh</li>
	</ol>

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
		@if (session('ADsuccess-addImage'))
		<div class="row alert alert-success">
			<div class="col-md-12 text-center">
				<h5 class="text-uppercase m-auto">{{ session('ADsuccess-addImage') }}</h5>
			</div>
		</div>
		@elseif (session('ADfailed-addImage'))
		<div class="row alert alert-success text-center">
			<h5 class="text-uppercase m-auto">{{ session('ADfailed-addImage') }}</h5>
		</div>
		@endif

		<div class="row">

			<div class="container">
				<div class="card">
					<header class="card-header">
						<h4 class="card-title mt-2 text-info">Thêm mới hình ảnh</h4>
					</header>
					<article class="card-body">
						<form action="{{ route('admin.add-image-handle') }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}

							<div class="form-group">
								<div class="form-group row">
									<label for="id_sanpham" class="col-sm-2 col-form-label label-upload-sp"><b>Chọn bài viết:</b></label>
									<div class="col-sm-10">
										<select name="id_sanpham" id="id_sanpham" class="selectpicker show-tick col-sm-8" required>
											<option value="" disabled selected hidden>Bài viết...</option>
											@foreach ($idAvailable as $value)
											<option value="{{ $value->id }}">{{ $value->id }} - {{ Str::words($value->ten_sp, 10) }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="id_sanpham" class="col-sm-2 col-form-label label-upload-sp"><b>Chọn hình ảnh</b></label>
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

							<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-lg btn-block">Thêm mới</button>
						</form>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection