<!-- Navigation -->
<div class="container" style="padding: 0 0;">
	<nav class="navbar navbar-light justify-content-center navbar-light" style="background-color: #055699;" id="navbar">

		<ul class="nav nav-pills" >
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('trangchu') }}">Trang chủ</a>
			</li>		
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('renting-product') }}" id="navbardrop" >Căn hộ cần cho thuê</a>
			</li>
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('selling-product') }}" id="navbardrop" >Căn hộ cần bán</a>
			</li>
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('news.newsindex') }}" id="navbardrop" >Tin tức nhà đất</a>
			</li>
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('about') }}" id="navbardrop" >Về chúng tôi</a>
			</li>
			<li class="nav-item dropdown nav-li">
				<a class="nav-link dropdown-toggle font-weight-bold nav-text" href="{{ route('contact') }}" id="navbardrop" >Liên hệ</a>
			</li>
		</ul>
	</nav>			
</div>

@push('scripts')
	<script>
		window.onscroll = function() {myFunction()};

		var navbar = document.getElementById("navbar");
		var sticky = navbar.offsetTop;

		function myFunction() {
			if (window.pageYOffset >= sticky) {
				navbar.classList.add("sticky")
			} else {
				navbar.classList.remove("sticky");
			}
		}
	</script>
@endpush