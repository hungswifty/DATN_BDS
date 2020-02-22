@extends('mainsite.base')

@section('content')

	<div class="container" style="border-left: 1px solid #F0F1F5; border-right: 1px solid #F0F1F5;">
		
		@foreach ($data['newsDetail'] as $value)
			<div class="news-imgbox">		
				<img class="img-fluid" src="{{ asset($value['anh_dd']) }}" width="100%" height="auto">
			</div>
			<div class="container-fluid">
				<div class="col-md-12">
					<h2 class="news_title pt-1" style="text-align: end;font-size:23px;">{{ $value['tieu_de'] }}</h2>
				</div>
		        <div class="row">
		            <div class="col-md-1 box_time">
		            	<img src="{{ asset ('img/clock.png') }}" class="img-createtime" alt="Some picture" width="30" height="30">
		            </div>
		            <div class="col-md-11"><i class="text-muted">{{ $value['created_at'] }}</i></div>
		        </div>
	    	</div>

	    	<hr>
	    	<div class="container-fluid" style="border-bottom:0.5px solid silver;">
				<div class="row">
					<div class="col-md-1">
						<a href="{{ route('news.newsindex') }}">
							<img src="{{ asset ('img/homepage.png') }}" class="img-responsive" alt="Quay lại trang tin tức" width="30" height="30" style="margin-left:50%;">
						</a>
					</div>
					<div class="col-md-8 d-flex justify-content-center ">
						<div class="content_box text-body container">
							{!!html_entity_decode($value['noi_dung'])!!}
						</div>
					</div>
					<div class="col-md-3">
						<div class="container py-3" style="border-left: 0.5px solid lightgrey;    background-color: #F7F7F7;">
							<h5 class="text-center mb-3" style="color:#27AD46;">Tin cùng danh mục</h5>
							@foreach ($data['newsCate'] as $value)
								<div class="card mb-3">
									<a href="{{ route('news.details',[ 'news_id' => $value['id'] ,'tieu_de' => Str::slug($value['tieu_de'], '-') ]) }}" class="a-card"><img class="card-img-top card-img-news" src="../../../{{ $value['anh_dd'] }}" alt="Card image cap">
									<div class="card-body">
											<h6>{{ $value['tieu_de'] }}</h6>
									</div>
									</a>
								</div>
							@endforeach
						</div>
					</div>

				</div>
			@endforeach 
			
				<div class="row col-md-9 comment-section">
					<h5 class="my-2">Bình luận</h5>
				</div>
				<form action="{{ route('news.comment',[ 'news_id' => $value['id'] ,'tieu_de' => Str::slug($value['tieu_de'], '-') ]) }}" method="POST" accept-charset="utf-8">
					
					@csrf
		
					<div class="row mt-1 col-md-9 comment-content">
						<div class="w-100">
							<label for="comment-content">Nội dung</label>
							<textarea class="form-control" id="comment-content" rows="3" name="noi_dung"></textarea>
						</div>
						<div class="w-100 mt-1 ">
							<button type="submit" class="btn btn-success float-right">Gửi bình luận</button>
						</div>
					</div>
				</form>

			@foreach ($data['comment'] as $value)
				<div class="row mt-1 col-md-9 comment-list">
					<div class="media comment-box">
						<div class="media-left">
							<a href="#">
								<img class="img-responsive user-photo" src="{{ asset($value['anhdaidien']) }}">
							</a>
						</div>
						<div class="media-body">
							<h4 class="media-heading">{{ $value['tentaikhoan'] }}</h4>
							<p>{{ $value['noidung_binhluan'] }}</p>
						</div>
					</div>
				</div>
			@endforeach

			</div>
		
	</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {           

				$(".img-user").attr("src", function(i, val) {
				  return '../../../'+val; //i == index, val == original attribute, the id
				});

		});
	</script>
@endpush