@extends('layouts.app')

@section('title', 'Official Ruang Kita | Ruang Kebaikan')
@section('meta_keywords', 'ruangkita, ruang kebaikan, ruang anak bontang, bontang go digital')
@section('meta_description', 'Official Ruang Kita | Ruang Kebaikan')

@section('content')

@include('includes.sidebar')

@include('includes.header_landing')

<!-- Begin page content -->
<div class="screen-wrap">
  <main class="app-content mw-mobile">
    <section class="padding-around pt-0 pb-0">
    	<div class="swiper-container swiper-slide-landing">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card-banner rounded bg-primary" style="width: 100%;">
                        <div class="card-body p-0">
                            <div class="product-image-large">
                                <a href="/about">
                                    <img style="width: 100%;" src="{{asset('assets/images/banners/slide-rk1.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="swiper-slide">
                    <div class="card-banner rounded" style="width: 100%;">
                        <div class="card-body p-0">
                            <div class="product-image-large">
                                <a href="/events/serba-serbi-luar-negeri">
                                    <img style="width: 100%;" src="{{asset('assets/images/banners/slide-rk3.jpg')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="swiper-slide">
                    <div class="card-banner rounded bg-secondary" style="width: 100%;">
                        <div class="card-body p-0">
                            <div class="product-image-large">
                                <a href="/consultations">
                                    <img style="width: 100%;" src="{{asset('assets/images/banners/slide-rk2.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-around pt-3">
    	<!-- <ul class="row">
    		<li class="col-3">
    			<a href="/articles?category=pendidikan" class="btn-card-icontop btn" style="background-color: white;">
    				<span class="icon">
    					<img src="{{asset('assets/images/icons/education-outline.png')}}"  style="height: 40px;">
    				</span>
    				<small class="text text-center text-dark" style="font-weight: bold">Pendidikan</small>
    			</a>
    		</li>
    		<li class="col-3">
    			<a href="/articles?category=kesehatan" class="btn-card-icontop btn" style="background-color: white;">
    				<span class="icon">
    					<img src="{{asset('assets/images/icons/medical-outline.png')}}" style="height: 40px;">
    				</span>
    				<small class="text text-center text-dark" style="font-weight: bold">Kesehatan</small>
    			</a>
    	    </li>
    	    <li class="col-3">
    			<a href="/articles?category=lingkungan" class="btn-card-icontop btn" style="background-color: white;">
    				<span class="icon">
    					<img src="{{asset('assets/images/icons/environment-outline.png')}}" style="height: 40px;">
    				</span>
    				<small class="text text-center text-dark" style="font-weight: bold">Lingkungan</small>
    			</a>
    	    </li>
    	    <li class="col-3">
    			<a href="/articles" class="btn-card-icontop btn" style="background-color: white;">
    				<span class="icon">
    					<img src="{{asset('assets/images/icons/more-outline.png')}}" style="height: 40px;">
    				</span>
    				<small class="text text-center text-dark" style="font-weight: bold">Lainnya</small>
    			</a>
    	    </li>
    	</ul> -->

      <a href="/stores">
      	<article class="card-banner rounded mt-1 mb-3" style="display: block; background-color: #fbd556;">
      		<span class="icon">
      			<img src="{{asset('assets/images/banners/item-shop1.png')}}" height="100" class="img-bg" style="left: 0; padding-left: 1rem; mix-blend-mode: unset;">
      		</span>
      		<div class="p-3" style="text-align: right;">
      		  <h5 class="card-title"><b style="font-weight: 700">tokokita</b> <small>by ruangkita.id</small></h5>
      		  <p class="small">Yuk belanja sekarang di tokokita<br>&nbsp;
              <!-- <a href="http://ruangkita.id" class="text-primary small"> Klik disini</a> -->
            </p>
      		</div>
      	</article>
      </a>
      <a href="/consultations" class="text-white">
      	<article class="card-banner rounded bg-primary mb-3">
      		<div class="p-3" style="width:70%">
      		  <h5 class="card-title text-white">Ruang Konsultasi</h5>
      		  <p class="text-white small">Layanan konsultasi chatting gratis</br>&nbsp;
      		  	<!-- <a href="/consultations" class="text-light small"> Klik disini</a> -->
      		  </p>
      		</div>
      		<span class="icon">
      			<img src="{{asset('assets/images/banners/item-consultation.svg')}}" height="100" class="img-bg" style="mix-blend-mode: unset; padding-right: .4rem;">
      		</span>
      	</article>
      </a>
    </section>

    <hr class="divider mb-3">

    <div class="row">
    	<div class="col-6">
    		<h5 class="title-section">Event Terdekat</h5>
    	</div>
    	<div class="col-6 text-right">
    		<small class="title-section mr-3">Semua Event</small>
    	</div>
    </div>

    <section class="scroll-horizontal padding-x">
    	<!-- <div class="item">
    		<a href="/events/serba-serbi-luar-negeri" class="product-sm">
    			<div class="img-wrap">
            <img src="{{asset('assets/images/events/serba-serbi-1.jpg')}}">
            <div class="container-absolute-events">
              <span class="label-absolute-events">Gratis</span>
            </div>
          </div>
    			<div class="text-wrap">
            <div class="price text-truncate-multiple">"Serba Serbi Luar Negeri" Mengupas Tuntas Cara Meraih Beasiswa Berkelas</div>
    				<small class="text-muted">Minggu 17-01-2021</small>
    			</div>
    		</a>
    	</div> -->
    </section>
  </main>
  @include('includes.footer')
  @include('includes.footer_navigation')
</div>

<!-- <hr class="divider my-3">

<div class="row">
	<div class="col-6">
		<h5 class="title-section">Artikel</h5>
	</div>
	<div class="col-6 text-right">
		<small class="title-section mr-3">Semua Artikel</small>
	</div>
</div>
<section class="scroll-horizontal  padding-x">

</section>

<hr class="divider my-3"> -->

<!-- <h5 class="title-section">Ruang Cerita</h5> -->


@endsection
