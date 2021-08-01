<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	 @include('includes.head')
	</head>
	<body>
		<div id="app">
			@yield('content')
		</div>
		<script src="{{asset('js/app.js')}}"></script>
		@include('includes.foot')
	</body>
</html>
