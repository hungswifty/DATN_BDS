@extends('mainsite.base')

@section('content')
			
	<!-- News -->
	<div class="container">
		
		<div class="row">
			<div class="col-lg-12 mt-3">
				{{-- TEST --}}
					{{-- @if (session()->has('tentaikhoan'))
					<h5> {{ dd(session()->all()) }} </h5>
					@else
					<h5> {{ dd('0') }} </h5>
					@endif --}}
				 {{--  --}}
				<p class="btn btn-primary"><b>Tin tức trong nước</b></p>
				
				{{-- $value[''] --}}
				@foreach ($data['dataTN'] as $key => $value)
					<div class="media pb-2 news-media">
						{{-- <a href="{{ url('detail/'.$value['id_dm'].'/'.$value['id'].'/') }}" title="#"> --}}
						<a href="{{ route('news.details',[ 'news_id' => $value['id'] ,'tieu_de' => Str::slug($value['tieu_de'], '-') ]) }}" title="{{ $value['tieu_de'] }}">
							<img class="align-self-start mr-3" src="{{ $value['anh_dd'] }}" width="130" height="130" alt="Hinh anh tin tuc">
							<div class="media-body">
							    <h5 class="mt-0">{{ $value['tieu_de'] }}</h5>
						</a>
							    <small class="d-block pb-1">Đăng lúc: {{ $value['created_at'] }}</small>
							    <small><p class="short-content">{{ Str::words(strip_tags($value['noi_dung']), 50, '...') }}</p></small>
						</div>
					</div>
					<br>
				@endforeach	
					
			</div>

			<div class="col-lg-12 mt-3">
				<p class="btn btn-primary"><b>Tin tức quốc tế</b></p>
				
				@foreach ($data['dataQT'] as $key => $value)
					<div class="media pb-2 news-media">
						<a href="{{ route('news.details',[ 'news_id' => $value['id'] ,'tieu_de' => Str::slug($value['tieu_de'], '-') ]) }}" title="{{ $value['tieu_de'] }}">
							<img class="align-self-start mr-3" src="{{ $value['anh_dd'] }}" width="130" height="130" alt="Hinh anh tin tuc">
							<div class="media-body">
							    <h5 class="mt-0">{{ $value['tieu_de'] }}</h5>
						</a>
							    <small class="d-block pb-1">Đăng lúc: {{ $value['created_at'] }}</small>
							    <small><p class="short-content">{{ Str::words(strip_tags($value['noi_dung']), 50, '...') }}</p></small>
						</div>
					</div>
					<br>
				@endforeach	
			</div>
		</div>
	</div>
	
	@endsection
	<!-- End News -->
	
	
	
