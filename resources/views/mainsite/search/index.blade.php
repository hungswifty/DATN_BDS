@extends('mainsite.base')

@section('content')
<div class="container" style="padding-left:0;padding-right: 0;">
	{{-- 	Slide --}}
	<div class="carousel_1">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
				<li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="{{ asset('upload/product/anhnha04.jpg') }}" class="w-100" alt="Can't load this picture">
					<div class="carousel-caption">
						<a href="#"><h5>Căn hộ gần kề Tây Hồ</h5></a>
					</div>
				</div>
				@foreach ($data as $value)
				<div class="carousel-item">
					<img @if ($value->nguon_anh != null)
					src="{{ $value->nguon_anh }}" 
					@else
					src="{{ asset('upload/product/no-image.png') }}"
					@endif
					class="w-100" alt="Can't load this picture">
					<div class="carousel-caption">
						<a href="{{ route('product-detail',[ 'product_id' => $value->id ,'product_title' => Str::slug($value->ten_sp, '-') ]) }}"><h5>{{ $value->ten_sp }}</h5></a>
						<p>{{ $value->ten_loaihinh }}</p>
						<p>{{ $value->loai_sp }}</p>
					</div>
				</div>
				@endforeach
			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Sau</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Trước</span>
			</a>
		</div>
	</div>
</div>
{{-- End Slide here --}}
<div class="container pt-2">

	<p>Tìm kiếm theo <kbd>tiêu chí</kbd></p>

	<div class="row mb-4">
		<div class="col-lg-12">
			<div class="card-deck">
				@foreach ($data as $value)
				<div class="col-sm-4 mb-3">	
					<div class="card">
						<a href="{{ route('product-detail',[ 'product_id' => $value->id ,'product_title' => Str::slug($value->ten_sp, '-') ]) }}"><img class="card-img-top" 
							@if ($value->nguon_anh != null)
							src="{{ $value->nguon_anh }}" 
							@else
							src="{{ asset('upload/product/no-image.png') }}"
							@endif
							alt="Card image cap" height="200"></a>
							<div class="card-body card-body-sp">
								<a href="{{ route('product-detail',[ 'product_id' => $value->id ,'product_title' => Str::slug($value->ten_sp, '-') ]) }}"><h6 class="card-title"><b>{{ $value->ten_sp }}</b></h6></a>
								<div class="row row-card">
									<p class="card-text h-detail1 col-sm-6"><b>Khu vực </b></p>
									<p class="col-sm-6"><small>: {{ $value->ten_khuvuc }}</small></p>
								</div>
								<div class="row row-card">
									<p class="card-text h-detail1 col-sm-6"><b>Tỉnh </b></p>
									<p class="col-sm-6"><small>: {{ $value->ten_tinhthanh }}</small></p>
								</div><div class="row row-card">
									<p class="card-text h-detail1 col-sm-6"><b>Loại hình </b></p>
									<p class="col-sm-6"><small>: {{ $value->ten_loaihinh }} {{ $value->loai_sp }}</small></p>
								</div><div class="row row-card">
									<p class="card-text h-detail1 col-sm-6"><b>Giá </b></p>
									@if ($value->gia_tien != null)
									<p class="col-sm-6"><small>: {{ $value->gia_tien }}</small></p>
									@else
									<p class="col-sm-6"><small>: Thỏa thuận</small></p>
									@endif
								</div><div class="row row-card">
									<p class="card-text h-detail1 col-sm-6"><b>Diện tích </b></p>
									<p class="col-sm-6"><small>: {{ $value->dien_tich }} m²</small></p>
								</div>
							</div>
							<div class="card-footer">
								<small class="text-muted">Đăng lúc : {{ $value->created_at }}</small>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="row">
			<div class="m-auto mb-3">
				{{  $data->links() }}
			</div>
		</div>
		
	</div>

</div>

@endsection
