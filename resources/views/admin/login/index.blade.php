<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login page</title>
	<link rel="stylesheet" href="{{ asset('css/admin/vendor/bootstrap/css/bootstrap.min.css') }}">
	<style>
		html{
  			height: 100%;
			}
		body{
			background: linear-gradient(137deg, #BC518E, #294B8B, #36928B);
			background-size: 600% 600%;

			-webkit-animation: AnimationName 4s ease infinite;
			-moz-animation: AnimationName 4s ease infinite;
			animation: AnimationName 4s ease infinite;
		}
		@keyframes AnimationName { 
			    0%{background-position:10% 0%}
			    50%{background-position:91% 100%}
			    100%{background-position:10% 0%}
			}
		.box-form{
			padding: 10px 10px;
			border: 2px solid pink;
			border-radius: 15px;
			position: fixed;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		    color:pink;
		    box-shadow: 
		    0 0 0 3px #BC518E,
		    0 0 0 5px #294B8B,
		    0 0 0 7px #36928B;
		    font-family: 'Baloo Bhai', cursive;
		}
		.box-form:hover{
			color: hotpink;
		}
		button{
		border:1px solid #2d9d92; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;font-size:12px;font-family:arial, helvetica, sans-serif; padding: 10px 10px 10px 10px; text-decoration:none; display:inline-block;text-shadow: -1px -1px 0 rgba(0,0,0,0.3);font-weight:bold; color: #FFFFFF;
		 background-color: #3BC7B9; background-image: -webkit-gradient(linear, left top, left bottom, from(#3BC7B9), to(#23538a));
		 background-image: linear-gradient(to bottom, #3BC7B9, #23538a);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#3BC7B9, endColorstr=#23538a);
		}
		button:hover{
			border:1px solid #237971;
			background-color: #2ea196; background-image: -webkit-gradient(linear, left top, left bottom, from(#2ea196), to(#193b61));
			background-image: -webkit-linear-gradient(top, #2ea196, #193b61);
			background-image: -moz-linear-gradient(top, #2ea196, #193b61);
			background-image: -ms-linear-gradient(top, #2ea196, #193b61);
			background-image: -o-linear-gradient(top, #2ea196, #193b61);
			background-image: linear-gradient(to bottom, #2ea196, #193b61);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#2ea196, endColorstr=#193b61);
			}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
					</div>
				</div>

				<div class="box-form mx-auto text-center ">
					<form action="{{ route('admin.handle-login') }}" method="POST" >
						@csrf {{-- lay token --}}
						<div class="form-group">
							<input type="text" name="user" id="user" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
						</div>
						<button type="submit" name="btnLogin" class="btn btn-primary btn-block">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>