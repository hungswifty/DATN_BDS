@extends('admin.base')

@section('content')
        <div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý bài viết</a>
              </li>
              <li class="breadcrumb-item active">Thêm bài viết</li>
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
				@if (session('status-addnews'))
					<div class="row alert alert-success">
						<div class="col-md-12 text-center">
				        	<h5 class="text-uppercase">{{ session('status-addnews') }}</h5>
						</div>
				    </div>
				@elseif (session('failed-addnews'))
					<div class="row alert alert-success text-center">
						<h5 class="text-uppercase">{{ session('failed-addnews') }}</h5>
					</div>
				@endif

				<div class="row">

					<div class="container">
						<div class="card">
							<div class="card-header">
								<h4 class="text-info">Thêm bài viết</h4>
							</div>
							<article class="card-body">
								<form action="{{ route('admin.add-post-handle') }}" method="POST" enctype="multipart/form-data">
								{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}

								<div class="form-group">
									<label for="noi_dung" class="font-weight-bold">Thể loại </label>
									<select name="the_loai" class="selectpicker show-tick">
										<option value="1">Tin trong nước</option>
										<option value="2">Tin nước ngoài</option>
									</select>
								</div>
								<div class="form-group">
									<label for="tieu_de" class="font-weight-bold">Tên tiêu đề</label>
									<input type="textarea" class="form-control"  placeholder="Tiêu đề bài viết" name="tieu_de">
								</div>
								<div class="form-group">
									<label for="noi_dung" class="font-weight-bold">Nội dung bài viết</label>
									<textarea class="form-control" id="testck_editor" name="noi_dung"></textarea> 
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Chọn ảnh tiêu đề</label>
									<input type="file" name="anh_dd">
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
        ClassicEditor.create( document.querySelector( '#testck_editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    </script>
@endpush