<aside class="offcanvas mw-mobile" id="sidebar_right">
	<div class="card-body bg-primary">
		<button class="btn-close close text-white">&times;</button>
		@guest
				<a href="/profile">
						<img class="img-sm rounded-circle" src="{{asset('assets/images/icons/profile-user.svg')}}" alt="">
				</a>
		@else
				<a href="/profile">
						<img class="img-sm rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
				</a>
		@endguest
		<!-- <img src="images/avatars/1.jpg" class="img-sm rounded-circle" alt=""> -->
		<h6 class="text-white mt-3 mb-0">Selamat Datang<br> @guest Sobat! @else {{ Auth::user()->name }} @endguest</h6>
	</div>
	<nav class="nav-sidebar">
		<a href="/"> <i class="fa fa-home"></i> Beranda</a>
		<!-- <a href="#"> <i class="fa fa-th"></i>	Categories</a> -->
		<a href="/about">  <i class="fa fa-info-circle"></i>Tentang
		Ruang Kita</a>
		<a href="/about-store">  <i class="fas fa-store"></i>Tentang
		Toko Kita</a>
		<a href="https://api.whatsapp.com/send?phone=6282153053443&text=Saya%20ingin%20menjalin%20kerjasama%20dengan%20Ruang%20Kita&source=https://www.ruangkita.id"> <i class="fa fa-phone"></i>Jalin Kerjasama</a>
		<!-- <a href="#">  <i class="fa fa-building"></i> Company</a>
		<a href="#">  <i class="fa fa-cog"></i> Settings</a>
		<a href="#"> <i class="fa fa-home"></i> All screens</a> -->
	</nav>
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> +62812-xxxx-xxxx</a>
		<a href="mailto:ruangkitabontang@gmail.com"> <i class="fa fa-envelope"></i> ruangkitabontang@gmail.com</a>
		<a href="#"> <i class="fa fa-map-marker"></i> Bontang, Kalimantan Timur</a>
	</nav>
	<div class="card-body">
		@guest
		@else
		<a href="/admin/dashboard" class="btn btn-block btn-warning text-white">
			<i class="fas fa-atlas"></i> Admin
		</a>
		@endguest

		@guest
		<a href="/login" class="btn btn-block btn-primary text-white">
			<i class="fas fa-sign-in-alt"></i> Masuk
		</a>
		@else
		<a href="/logout" class="btn btn-block btn-danger text-white">
			<i class="fas fa-sign-out-alt"></i> Keluar
		</a>
		@endguest
	</div>
</aside>
