@extends('mainsite.base')

@section('content')
<div class="container box">
	
	
	<h3 align="center">Ajax Dynamic Dependent Dropdown in Laravel</h3><br />
	<div class="form-group">
		<select name="khu_vuc" id="id_khuvuc" class="form-control input-lg " data-dependent="ten_tinhthanh" >
			<option value="" disabled selected hidden>Chọn Vùng miền</option>
			@foreach($data as $khuvuc)
			<option value="{{ $khuvuc->id }}">{{ $khuvuc->ten_khuvuc }}</option>
			@endforeach
		</select>
	</div>
	<br />
	<div class="form-group">
		<select name="tinh_thanh" id="id_tinhthanh" class="form-control input-lg " data-dependent="ten_quanhuyen">
			<option value="" disabled selected hidden> Chọn Tỉnh Thành</option>
		</select>
	</div>
	<br />
	<div class="form-group">
		<select name="quan_huyen" id="id_quanhuyen" class="form-control input-lg">
			<option value="" disabled selected hidden>Chọn Quận/Huyện</option>
		</select>
	</div>
	<h6 style="color:pink;">Cảm ơn bạn đã đóng góp</h6>
	{{ csrf_field() }}
	<br />
	<br />
</div>
@endsection

@push('scripts')
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