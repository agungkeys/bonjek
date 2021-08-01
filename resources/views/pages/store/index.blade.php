@extends('layouts.app')

@section('title', 'TokoKita by Ruang Kita | Ruang Kebaikan')
@section('meta_keywords', 'toko kita, umkm, umkm bontang, list umkm bontang, daftar umkm bontang')
@section('meta_description', 'TokoKita/UMKM Kota Bontang, Pemberdayaan Ekonomi Kreatif Kota Bontang')

@section('content')

@include('includes.header_landing_store')

<div class="screen-wrap">
  <main class="app-content mw-mobile">
    <section class="padding-around">
        <ul class="row">
        	<li class="col-4">
        		<div class="btn-card-icontop btn" style="background: none;">
        			<span class="icon"> <img style="height: 55px;" src="{{asset('assets/images/icons/how_1.svg')}}" alt="">  </span>
        			<small class="text text-center text-dark">Pemesanan Mudah</small>
        		</div>
        	</li>
        	<li class="col-4">
        		<div class="btn-card-icontop btn" style="background: none;">
        			<span class="icon"> <img style="height: 55px;" src="{{asset('assets/images/icons/how_2.svg')}}" alt=""> </span>
        			<small class="text text-center text-dark">Pengiriman Cepat</small>
        		</div>
            </li>
            <li class="col-4">
        		<div class="btn-card-icontop btn" style="background: none;">
        			<span class="icon"> <img style="height: 55px;" src="{{asset('assets/images/icons/how_3.svg')}}" alt=""> </span>
        			<small class="text text-center text-dark">Pelanggan Senang</small>
        		</div>
            </li>
        </ul>
    </section>
    <section class="padding-around">
    <div class="row">
        <div class="col-12 pb-2">
            <a href="/merchant" class="btn btn-md btn-block btn-outline-primary"><i class="fas fa-store"></i>&nbsp;&nbsp;Daftarkan Toko/Lapak Sekarang</a>
        </div>
    </div>
      <div class="row">
        @foreach($stores as $store)
          <a class="col-5 col-md-4 pb-3" href="/stores/{{$store->slug}}">
            <div class="item">
              <div class="product-sm">
                <div class="img-wrap">
                  <img loading="lazy" alt="{{$store->name}}" src="{{asset($store->logo)}}">
                </div>
              </div>
            </div>
          </a>
          <a class="col-7 col-md-8 pb-3" href="/stores/{{$store->slug}}">
            <div class="text-wrap">
              <span class="badge badge-warning">{{$store->storeCategory->name}}</span>
              <div class="price text-truncate-multiple pt-2">{{$store->name}}</div>
              <span class="small text-muted">{{$store->city->name}} - {{$store->district->name}}</span>
              <div>
                <span class="small text-muted"><i class="far fa-clock"></i> {{$store->store_open}} - {{$store->store_close}}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </section>
    <!-- <section class="padding-around pt-0 pb-0" style="text-align: center; margin: 1em 0;">
      <img style="width: 100%; max-width: 250px; vertical-align: middle; padding-top: 30vh;" src="{{asset('assets/images/store-maintenance.png')}}" />
    </section> -->
    @include('includes.footer_basket')
  </main>
  @include('includes.footer_navigation')
</div>
@endsection
