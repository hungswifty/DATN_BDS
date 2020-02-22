@extends('admin.base')

@section('content')
        <div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý hình ảnh</a>
              </li>
              <li class="breadcrumb-item active">Sửa hình ảnh</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-info">Sửa hình ảnh</h4>
                </div>
            </div>

            <div >
            	{{-- Thong bao khong nhap / sai dinh dang--}}
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
				@if (session('ADsuccess-editImage'))
					<div class="row alert alert-success">
						<div class="col-md-12 text-center">
							<h6 class="text-uppercase m-auto">{{ session('ADsuccess-editImage') }}</h6>
						</div>
					</div>
				@elseif (session('ADfailed-editImage'))
					<div class="row alert alert-danger text-center">
						<h6 class="text-uppercase m-auto">{{ session('ADfailed-editImage') }}</h6>
					</div>
				@endif
			

	            <div class="row">
	            
	            	<div class="container">
	            		<form action="{{ route('admin.edit-image-handle') }}" method="POST" enctype="multipart/form-data">
	            			{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}
	            		@foreach ($data as $value)
	            			
	            			<div class="form-group row">
	            				<label for="id_hinhanh" class="font-weight-bold col-sm-1 col-form-label">ID</label>
	            				<div class="col-sm-11">
	            					<input type="text" id="id_hinhanh" readonly class="form-control-plaintext" name="id_hinhanh" value="{{ $value->id }}">
	            				</div>
	            			</div>

							<div class="form-group">
								<div class="form-row">
									<label><b>Ảnh hiện tại</b></label>
								</div>
								<div class="form-row">
									<img src="../../{{ $value->nguon_anh }}" alt="anhdd" width="300" height="300">
								</div>
							</div>

							<div class="form-group">
								<label class="font-weight-bold">Chọn ảnh mới</label>
								<input type="file" name="anh_new">
							</div>

	            			<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-block">Lưu thông tin</button>
	            		
	            		@endforeach	
	            		</form>
	            	</div>
	            </div>
            </div>
        </div>
@endsection