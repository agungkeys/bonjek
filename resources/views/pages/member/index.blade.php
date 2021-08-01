@extends('layouts.app')

@section('content')
<!-- Begin page content -->
<div class="screen-wrap">
  <header class="app-header bg-primary" style="margin-left: -8px; margin-right: -8px; position: fixed; top: 0;">
    <div class="mw-mobile" style="width: 100%; display: flex; -webkit-box-pack: justify; justify-content: space-between;">
      <a href="javascript:history.go(-1)" class="btn-header">
        <i class="fa fa-arrow-left"></i>
      </a>
      <div class="header-right"> <a href="/logout" class="btn-header">Keluar</a></div>
    </div>
  </header> <!-- section-header.// -->


  <main class="app-content mw-mobile mb-5">
    <section class="padding-x pb-3 bg-primary text-white" style="margin-left: -8px; margin-right: -8px; margin-top: 60px;">
    	<figure class="icontext align-items-center mr-4" style="max-width: 300px;">
    	    @if(Auth::user()->profile)
    	        <img class="icon icon-md rounded-circle" src="{{ Auth::user()->profile->img ? asset(Auth::user()->profile->img) : asset(Auth::user()->avatar) }}">
    	    @else
    	        <img class="icon icon-md rounded-circle" src="{{ asset(Auth::user()->avatar) }}">
    	    @endif
    		<figcaption class="text">
    			<p class="h5 title">{{ Auth::user()->name }}</p>
    			<p class="text-white-50">{{ Auth::user()->telp }}</p>
    		</figcaption>
    	</figure>
    </section>

    <section class="padding-around">
    	<ul class="row">
    		<li class="col-4">
    			<a href="#" class="btn-card-icontop btn">
    				<span class="icon"> <i class="fa fa-book"></i> </span>
    				<small class="text text-center">Konten Kita</small>
    			</a>
    		</li>
    		<li class="col-4">
    			<a href="#" class="btn-card-icontop btn">
    				<span class="icon"> <i class="fa fa-shopping-basket"></i> </span>
    				<small class="text text-center">Pesanan Saya</small>
    			</a>
    		</li>
    		<li class="col-4">
    			<a href="/merchant" class="btn-card-icontop btn">
    				<span class="icon"> <i class="fas fa-store"></i> </span>
    				<small class="text text-center">Toko Kita</small>
    			</a>
    		</li>
    	</ul>
    </section>

    <hr class="divider">

    <!-- <section class="padding-top">
    <h5 class="title-section padding-x">Orders</h5>
    <nav class="nav-list">
    	<a class="btn-list" href="#">
    		<span class="float-right badge badge-warning">3</span>
    		<span class="text">On proccess</span>
    	</a>
    	<a class="btn-list" href="#">
    		<span class="float-right badge badge-success">1</span>
    		<span class="text">Shipped</span>
    	</a>
    	<a class="btn-list" href="#">
    		<span class="float-right badge badge-secondary">0</span>
    		<small class="title"></small>
    		<span class="text">Unpaid</span>
    	</a>
    </nav>
    </section> -->

    <!-- <hr class="divider">

    <section class="padding-top">
    	<h5 class="title-section padding-x">Account</h5>
    	<nav class="nav-list">
    		<a class="btn-list" href="#">
    			<i class="icon-control fa fa-chevron-right"></i>
    			<span class="text">Notifications</span>
    		</a>
    		<a class="btn-list" href="#">
    			<i class="icon-control fa fa-chevron-right"></i>
    			<span class="text">Settings</span>
    		</a>
    		<a class="btn-list" href="#">
    			<i class="icon-control fa fa-chevron-right"></i>
    			<span class="text">Support</span>
    		</a>
    	</nav>
    </section> -->

    <!-- <hr class="divider"> -->

    <section class="padding-top">
      <h5 class="title-section padding-x">Profil Saya</h5>
      <nav class="nav-list">
        @if(Auth::user()->name)
          <div class="btn-list">
        		<small class="title">Nama</small>
        		<span class="text">{{ Auth::user()->name }}</span>
        	</div>
        @else
          <a class="btn-list" href="/profile/{{Auth::user()->id}}/edit">
        		<i class="icon-action fa fa-pen"></i>
        		<small class="title">Nama</small>
        		<span class="text">{{ Auth::user()->name }}</span>
        	</a>
        @endif

        @if(Auth::user()->email)
          <div class="btn-list">
        		<small class="title">Email</small>
        		<span class="text">{{ Auth::user()->email }}</span>
        	</div>
        @else
          <a class="btn-list" href="/profile/{{Auth::user()->id}}/edit">
        		<i class="icon-action fa fa-pen"></i>
        		<small class="title">Email</small>
        		<span class="text">{{ Auth::user()->email }}</span>
        	</a>
        @endif

        @if(Auth::user()->telp)
          <div class="btn-list" >
        		<small class="title">Handphone</small>
        		<span class="text">{{ Auth::user()->telp }}</span>
        	</div>
        @else
          <a class="btn-list" href="/profile/{{Auth::user()->id}}/edit">
        		<i class="icon-action fa fa-pen"></i>
        		<small class="title">Handphone</small>
        		<span class="text">{{ Auth::user()->telp }}</span>
        	</a>
        @endif

        @if(Auth::user()->created_at)
          <div class="btn-list">
        		<small class="title">Tanggal Registrasi</small>
        		<span class="text">{{ Auth::user()->created_at->format('d F Y') }}</span>
        	</div>
        @else
          <a class="btn-list" href="/profile/{{Auth::user()->id}}/edit">
        		<i class="icon-action fa fa-pen"></i>
        		<small class="title">Tanggal Registrasi</small>
        		<span class="text">{{ Auth::user()->created_at->format('d F Y') }}</span>
        	</a>
        @endif

      </nav>
    </section>
    <a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-block btn-primary btn-flat float-right mb-2">Perbaharui Data User</a>
  </main>
  @include('includes.footer_navigation')
</div>
@endsection
