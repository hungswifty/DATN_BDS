@extends('admin.base')

@section('content')
        <div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý loại sản phẩm</a>
              </li>
              <li class="breadcrumb-item active">Thêm loại sản phẩm</li>
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
				@if (session('ADsuccess-addProCate'))
					<div class="row alert alert-success">
						<div class="col-md-12 text-center">
				        	<h5 class="text-uppercase">{{ session('ADsuccess-addProCate') }}</h5>
						</div>
				    </div>
				@elseif (session('ADfailed-addProCate'))
					<div class="row alert alert-success text-center">
						<h5 class="text-uppercase">{{ session('ADfailed-addProCate') }}</h5>
					</div>
				@endif

				<div class="row">

					<div class="container">
						<div class="card">
							<div class="card-header">
								<h4 class="text-info">Thêm loại sản phẩm</h4>
							</div>
							<article class="card-body">
								<form action="{{ route('admin.add-productcate-handle') }}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}
								
								<div class="form-row">
									<div class="col form-group">
										<label>Nhập tên loại sản phẩm mới:</label>
										<input type="text" class="form-control" placeholder="Tên loại sản phẩm" name="loai_sp" required>
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
