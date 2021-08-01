@extends('layouts.app')

@section('title', 'Official Bonjek - Bontang Ojek')
@section('meta_keywords', 'bonjek, bontang ojek, ojek umkm, ojek online, delivery courier')
@section('meta_description', 'Bonjek adalah aplikasi ojek online karya anak bontang, yang siap merajai ojek online di daerah Kalimantan Timur.')

@section('content')
@include('includes.preloader')

@include('includes.sidebar')

@include('includes.header_landing')
<main class="app-content mw-mobile">
  <section class="px-3 pb-3 pt-1 bg-primary" style="background-image: linear-gradient(to bottom, #f02d8a, #ff4da2) !important;">
    <div class="row row-cols-2">
      <div class="col">
        <p class="text-white pt-1 mb-1">Hai, sobat bonjek 👋</p>
      	<h6 class="text-white mb-0" style="width: max-content; font-weight: 300;">Pesan Makan Di Rumah Aja <br> BONJEK-in aja</h6>
      </div>
      <div class="col">
        <div class="text-right" style="position: absolute; top: -1.5em; right: -1em;">
          <img style="width: 12em;" src="{{asset('assets/images/maskot-new.svg')}}" />
        </div>
      </div>
    </div>

  	<!-- <input type="text" placeholder="Search" class="form-control border-0 shadow-sm"> -->
  </section>

  <section class="bg-primary padding-around px-3 pb-5 rounded-bottom" style="height: 4em; background-image: linear-gradient(to bottom, #ff4da2, #ffb6da) !important;">
  </section>

  <section class="px-3" style="margin-top: -4em;">
    <div class="swiper-container swiper-slide-landing">
      <div class="swiper-wrapper">
        @foreach($banners as $banner)
        <div class="swiper-slide">
          <div class="card-banner rounded bg-primary" style="width: 100%;">
            <div class="card-body p-0">
              <div class="product-image-large">
                <a href="{{$banner->link}}">
                  <img style="max-height: 17em; object-fit: cover; width: 100%;" src="{{asset('storage/'.$banner->extra_large)}}" alt="{{$banner->name}}">
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>


  <section>
  	<h5 class="title-section">UMKM Terpopular</h5>
  	<div class="p-3 scroll-horizontal">

      @foreach($stores_popular as $store)
  		<div class="item">
  			<a href="/umkm/{{$store->slug}}" class="product">
  				<div class="img-wrap">
            <img loading="lazy" alt="{{$store->name}}" src="{{asset($store->logo)}}">
            <span class="badge badge-product">{{$store->storeCategory->name}}</span>
          </div>
  				<div class="text-wrap">
            <p class="title text-truncate" style="font-size: 11px;">{{$store->district->name}} - {{$store->city->name}}</p>
  					<div class="price text-truncate-2" style="height: 2.5em;">{{$store->name}}</div>
  				</div>
  			</a>
  		</div>
      @endforeach

  	</div>
  </section>

  <hr class="divider" size="10">

  <section>
  	<h5 class="title-section pb-4">Rekomendasi UMKM</h5>
    <div class="row mx-3">

      @foreach($stores as $store)
      <div class="col-6 col-sm-3 col-md-3 col-lg-2 pb-3">
        <div class="item">
    			<a href="/umkm/{{$store->slug}}" class="product">
    				<div class="img-wrap">
              <img loading="lazy" alt="{{$store->name}}" src="{{asset($store->logo)}}">
              <span class="badge badge-product">{{$store->storeCategory->name}}</span>
            </div>
    				<div class="text-wrap">
              <p class="title text-truncate" style="font-size: 11px;">{{$store->district->name}} - {{$store->city->name}}</p>
    					<div class="price text-truncate-2" style="height: 2.5em;">{{$store->name}}</div>
    				</div>
    			</a>
    		</div>
      </div>
      @endforeach

    </div>
  </section>
</main>

@include('includes.footer')
@include('includes.footer_navigation')
<style>
  .img-wrap{
    border: 5px solid red;
    text-align: center;
    width: 50vw;
    height: 50vw;
  }
</style>
@endsection
