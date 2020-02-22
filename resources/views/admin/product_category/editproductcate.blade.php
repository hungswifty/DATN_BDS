@extends('admin.base')

@section('content')
        <div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý loại sản phẩm</a>
              </li>
              <li class="breadcrumb-item active">Sửa thông tin loại sản phẩm</li>
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
				@if (session('ADsuccess-editProCate'))
					<div class="row alert alert-success">
						<div class="col-md-12 text-center">
				        	<h5 class="text-uppercase">{{ session('ADsuccess-editProCate') }}</h5>
						</div>
				    </div>
				@elseif (session('ADfailed-editProCate'))
					<div class="row alert alert-success text-center">
						<h5 class="text-uppercase">{{ session('ADfailed-editProCate') }}</h5>
					</div>
					@endif

				<div class="row">

					<div class="container">
						<div class="card">
							<div class="card-header">
								<h4 class="text-info">Sửa thông tin loại sản phẩm</h4>
							</div>
							<article class="card-body">
								<form action="{{ route('admin.edit-productcate-handle') }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}
								@foreach ($data as $value)
									
								@endforeach

								<div class="form-row">
									<div class="col form-group">
										<label>ID:</label>
										<input type="text" class="form-control" name="id_loaisp" readonly value="{{ $value->id }}">
									</div> 
								</div>
								<div class="form-row">
									<div class="col form-group">
										<label>Tên loại sản phẩm hiện tại</label>
										<input type="text" class="form-control" value="{{ $value->loai_sp }}" readonly>
									</div>
								</div>

								<div class="form-row">
									<div class="col form-group">
										<label>Nhập tên loại sản phẩm mới:</label>
										<input type="text" class="form-control" placeholder="Tên loại sản phẩm" name="loai_sp" required>
									</div> 
								</div>
								
								<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary btn-lg btn-block">Lưu lại</button>
							</form>
							</article>
							
						</div>
					</div>

				</div>
			</div>
		</div>
@endsection
