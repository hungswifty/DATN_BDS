@extends('admin.base')

@section('content')
        <div class="container-fluid">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#">Quản lý bài viết</a>
              </li>
              <li class="breadcrumb-item active">Sửa bài viết</li>
            </ol>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-info">Sửa bài viết</h4>
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
				@if (session('status-editnews'))
					<div class="row alert alert-success">
						<div class="col-md-12 text-center">
				        	<h5 class="text-uppercase">{{ session('status-editnews') }}</h5>
						</div>
				    </div>
				@elseif(session('failed-editnews'))
					<div class="row alert alert-success text-center">
						<h5 class="text-uppercase">{{ session('failed-editnews') }}</h5>
					</div>
				@endif
			

	            <div class="row">
	            
	            	<div class="container">
	            		<form action="{{ route('admin.edit-post-handle') }}" method="POST" enctype="multipart/form-data">
	            			{{ csrf_field() }} {{-- KHONG DUOC QUEN KHI TAO FORM NEU KHONG SE ERROR --}}
	            		@foreach ($detail as $value)
	            			
	            			<div class="form-group row">
	            				<label for="id_baiviet" class="font-weight-bold col-sm-1 col-form-label">ID</label>
	            				 <div class="col-sm-11">
	            				<input type="text" readonly class="form-control-plaintext" name="id_baiviet" value="{{ $value['id'] }}">
	            			</div>
	            			</div>

	            			<div class="form-group">
	            				<label for="noi_dung" class="font-weight-bold">Thể loại </label>
	            				<select name="the_loai" class="selectpicker show-tick">
	            					@if ($value['id_dm'] == 1)
	            						<option value="1" selected>Tin trong nước</option>
	            						<option value="2">Tin nước ngoài</option>
	            					@else 
	            						<option value="1" >Tin trong nước</option>
	            						<option value="2" selected>Tin nước ngoài</option>
	            					@endif
								  	
									
								</select>
	            			</div>
	            			<div class="form-group">
							    <label for="tieu_de" class="font-weight-bold">Tên tiêu đề</label>
							    <input type="textarea" class="form-control"  placeholder="Tiêu đề bài viết" name="tieu_de" value="{{ $value['tieu_de'] }}">
							</div>
							<div class="form-group">
								<label for="noi_dung" class="font-weight-bold">Nội dung bài viết</label>
								<textarea class="form-control" id="testck_editor" name="noi_dung" >{{ $value['noi_dung'] }}</textarea> 
							</div>
							<div class="form-group">
								<label>Ảnh tiêu đề hiện tại</label>
								<img src="../../{{ $value['anh_dd'] }}" alt="anhdd" width="150" height="150">
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Chọn ảnh tiêu đề</label>
								<input type="file" name="anh_dd">
							</div>

	            			<button type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary">Sửa</button>
	            		
	            		@endforeach	
	            		</form>
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