<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
<meta name="keywords" content="@yield('meta_keywords','bonjek, bonjek bontang, bonjek indonesia')">
<meta name="description" content="@yield('meta_description','Official Bonjek Indonesia')">
<meta name="author" content="Official Bonjek - Karya Anak Bontang">
<link rel="canonical" href="{{url()->current()}}"/>
<!-- <meta name="generator" content=""> -->
<title>@yield('title','Official Bonjek')</title>

<meta property="og:locale" content="id_ID" />
<meta property="og:site_name" content="bonjek.com" />
<meta property="og:type" content="@yield('og_type','landing')" />
<meta property="og:title" content="@yield('title','Official Bonjek Indonesia')" />
<meta property="og:description" content="@yield('meta_description','Bonjek Indonesia')" />
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:updated_time" content="@yield('og_updated_time','')" />
<meta property="og:image" content="@yield('og_image',asset("assets/images/bonjek.svg"))" />
<meta property="og:image:secure_url" content="@yield('og_image',asset("assets/images/bonjek.svg"))" />
<meta property="og:image:width" content="825" />
<meta property="og:image:height" content="825" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="@yield('meta_description','Official Bonjek Indonesia')" />
<meta name="twitter:title" content="@yield('title','Official Bonjek Indonesia')" />
<meta name="twitter:image" content="@yield('og_image',asset("assets/images/bonjek.svg"))" />


<!-- manifest meta -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- <link rel="manifest" href="manifest.json" /> -->

<link href="{{asset('css/app.css')}}" rel="stylesheet">

<!-- Favicons -->
<link rel="apple-touch-icon" href="{{asset('assets/images/favicon/apple-touch-icon.png')}}" sizes="180x180">
<link rel="icon" href="{{asset('assets/images/favicon/favicon-32x32.png')}}" sizes="32x32" type="image/png">
<link rel="icon" href="{{asset('assets/images/favicon/favicon-16x16.png')}}" sizes="16x16" type="image/png">

<!-- Bootstrap4 files-->
<link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>

<!-- Custom style bonjek -->
<link href="{{asset('assets/css/ui.css')}}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" type="text/css" rel="stylesheet">

<!-- Fonticon -->
<link href="{{asset('assets/fonts/material-icon/css/round.css')}}" rel="stylesheet" type="text/css" />

<!-- swiper CSS -->
<link href="{{asset('assets/vendor/swiper/css/swiper.min.css')}}" rel="stylesheet">

<!-- Fancy Box -->
<link href="{{asset('assets/plugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">

<!-- leaflet open street map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>

<meta name="csrf-token" content="{{ csrf_token() }}" />
