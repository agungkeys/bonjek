<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	 @include('includes.admin_head')
	</head>
	<body>
		<div id="app">
			<div class="splash active">
				<div class="splash-icon"></div>
			</div>
			<div class="wrapper">
				@include('includes.admin_sidebar')
				<div class="main">
					@include('includes.admin_header')
					@yield('content')
					@include('includes.admin_footer')
				</div>
			</div>
		</div>
		
		<script src="{{asset('js/app.js')}}"></script>
		@include('includes.admin_foot')
		@yield('foot_js')
	</body>
</html>
