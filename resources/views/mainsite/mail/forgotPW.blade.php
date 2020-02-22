<!DOCTYPE html>
<html>
<head>
	<title>Thay đổi mật khẩu đăng nhập</title>
</head>
<body>
	<div class="box" style="border:2px solid lightblue;width:500px;height: 250px; text-align: center;">
	@foreach ($userDT as $value)
		<p>Xin chào {{ $value['tentaikhoan'] }} !</p>
		<p>Chúng tôi rất tiếc vì sự cố đăng nhập với tài khoản của bạn, email này thay lời xin lỗi cùng với mật khẩu mới của bạn</p>
		<p>Mật khẩu mới của bạn là:</p>
		<div >
			<p><b style="border:2px solid silver;padding:10px 10px;">{{ $value['matkhau'] }}</b></p>
		</div>
		<p><i>Chúc bạn một ngày vui vẻ!</i></p>
	@endforeach
	</div>
</body>
</html>