@extends('layouts.app')

@section('title', $store[0]['name'].' | Official Bonjek - Bontang Ojek')
@section('meta_keywords', $store[0]['name'].' bonjek, bontang ojek, ojek umkm, ojek online, delivery courier')
@section('meta_description', $store[0]['description'])

@section('content')

@include('includes.header_store')

<div class="screen-wrap">
  <main class="app-content mw-mobile">
    <section class="padding-around">
      <div class="row">
        <div class="col-5 col-md-4">
          <div class="item">
            <div class="img-wrap">
              <img src="{{asset('storage/'.$store[0]['small'])}}">
            </div>
          </div>
        </div>
        <div class="col-7 col-md-8 pb-3">
          <div class="text-wrap">
            <span class="badge badge-pill bg-purple">{{$store[0]['storeCategory']->name}}</span>
            <div class="price text-truncate-multiple pt-2 size-16-bold">{{$store[0]['name']}}</div>
            <div class="row">
              <div class="col-xs-12 col-md-auto">
                <span class="small size-13 color-primary">{{$store[0]['city']->name}} - {{$store[0]['district']->name}}</span>
              </div>
              <div class="col-xs-12 col-md-auto">
                <span class="small size-13 color-primary"><i class="far fa-clock"></i> {{$store[0]['store_open']}} - {{$store[0]['store_close']}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr class="pt-1 mb-2">
    <div class="py-2 pl-2 scroll-horizontal" style="padding-bottom: .65em !important; position: sticky; top: 3.7em; z-index: 3; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
      @foreach($products as $category => $bulk)
    		<a href="#{{$data_product_sub_categories->firstWhere('id',$category)->slug}}" class="badge badge-pill py-2 text-white" style="background-color: #a84291; border-radius: 1em;">
  				<span class="p-1" style="font-size: 14px; font-weight: normal;">{{$data_product_sub_categories->firstWhere('id',$category)->name}}</span>
    		</a>
      @endforeach
    </div>


    <section class="padding-around pt-0 pb-5">
      @foreach($products as $category => $bulk)
      <div class="row">
          <div class="pt-2" style="width: 100%;">
            <h5 id="{{$data_product_sub_categories->firstWhere('id',$category)->slug}}" class="title-category">
              <span class="text-primary">{{$data_product_sub_categories->firstWhere('id',$category)->name}}</span>
            </h5>
          </div>
          @forelse($bulk as $product)
          <div class="col-6 col-sm-6 col-md-4 pt-2">
        		<a class="product-sm mb-3">
        			<div class="img-wrap">
                <img src="{{asset($product->thumbnailUrl())}}">
              </div>
        			<div class="text-wrap">
        				<div class="text-wrap">
          				<span class="text-truncate-multiple">{{$product->name}}</span>
                  @if($product->discount)
                  </br>
                  <span class="badge-danger small" style="border-radius: 3px; background-color: rgb(255, 234, 239); font-weight: bold; color: rgb(255, 92, 132); padding: 1px 4px;">{{$product->discount}}%</span>
                  <span class="text-muted" style="font-size: 11px; text-decoration: line-through;">{{priceFormat($product->price)}}</span>
          				<div class="price pt-1"><span style="font-weight: bold;">{{priceFormat(calculateDiscount($product->price, $product->discount))}}</span></div>
                  @else
                  <div class="price pt-1"><span style="font-weight: bold;">{{priceFormat($product->price)}}</span></div>
                  @endif
          			</div>
        			</div>
        		</a>
            <div class="atc atc-item-{{$product->id}} clear">
              <input type="hidden" name="store_id" value="{{$store[0]['district']->id}}">
              <input type="hidden" name="store_slug" value="{{$store[0]['slug']}}">
              <input type="hidden" name="store_district" value="{{$store[0]['district']->name}}">
              <input type="hidden" name="item_id" value="{{$product->id}}">
              <input type="hidden" name="item_image" value="{{$product->thumbnailUrl()}}">
              <input type="hidden" name="item_name" value="{{$product->name}}">
              <input type="hidden" name="item_price" value="{{$product->discount ? calculateDiscount($product->price, $product->discount) : $product->price}}">
              <input type="hidden" name="item_weight" value="{{$product->weight}}">
              <input type="hidden" name="item_weight_variant" value="{{$product->weight_variant}}">

              <button class="btn btn-sm btn-block btn-primary add button-add">Beli</button>

              <div class="input-group input-group-sm pb-2 input-spinner qty qty-selector" style="width: 100%; display: none">
            		<div class="input-group-prepend">
            			<button class="btn btn-light minus button-qty" type="button" data-qty-action="minus"> <i class="fa fa-minus"></i> </button>
            		</div>
            		<input readonly type="number" class="form-control" min="0" value="0" name="qty" style="width: 100%; max-width: 100%;flex-basis: auto;">
            		<div class="input-group-append">
            			<button class="btn btn-light plus button-qty" type="button" data-qty-action="plus"> <i class="fa fa-plus"></i> </button>
            		</div>
            	</div>
            </div>
          </div>
          @empty
          <div class="col-12">
            <span>data barang ditoko ini tidak ditemukan</span>
          </div>
          @endforelse
      </div>
      @endforeach
    </section>
    <!-- <section class="padding-around pt-0 pb-0" style="text-align: center; margin: 1em 0;">
      <img style="width: 100%; max-width: 250px; vertical-align: middle; padding-top: 30vh;" src="{{asset('assets/images/store-maintenance.png')}}" />
    </section> -->
    @include('includes.footer_basket')
  </main>

  @include('includes.footer_navigation')
</div>
@endsection
<style>
  .foreground{
    width: 100%;
    backdrop-filter: blur(20px);
  }
</style>
