@extends('layouts.app')

@section('content')
<!-- Begin page content -->
<div class="screen-wrap">
  <header class="app-header bg-primary" style="margin-left: -8px; margin-right: -8px; position: fixed; top: 0;">
    <div class="mw-mobile" style="width: 100%; display: flex; -webkit-box-pack: justify; justify-content: space-between;">
      <div class="row">
        <a href="/profile" class="btn-header">
          <i class="fa fa-arrow-left"></i>
        </a>
        <span class="text-white lead" style="padding: 2px"><strong>Kelola Toko</strong></span>
      </div>
      <div>
        <a href="/logout" class="btn-header">Keluar</a>
      </div>
    </div>
  </header> <!-- section-header.// -->


  <main class="app-content mw-mobile">
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
    @if($store)
    <section class="padding-around mt-2">
      @if(!$store->status)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Toko anda sedang menunggu moderasi admin <i class="fas fa-diagnoses"></i>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @else
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        Selamat! toko anda sudah tayang.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="row">
        <div class="col-5 col-md-4">
          <div class="item">
            <div class="product-sm">
              <div class="img-wrap">
                @if($store->status)
                <img src="{{asset($store->logo)}}">
                @else
                <img style="filter: grayscale(100%)" src="{{asset($store->logo)}}">
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-7 col-md-8">
          <div class="text-wrap">
            <span class="badge badge-warning">{{$store->storeCategory->name}}</span>
            <div class="price text-truncate-multiple pt-2">{{$store->name}}</div>
            <span class="small text-muted">{{$store->city->name}} - {{$store->district->name}}</span>
            <div>
              <span class="small text-muted"><i class="far fa-clock"></i> {{$store->store_open}} - {{$store->store_close}}</span>
            </div>
            <div class="pt-1">
              <a href="/merchant/{{$store->id}}/edit" class="small text-warning">
                <i class="fas fa-pencil-alt"></i> Perbaharui Data Toko
              </a>
            </div>
          </div>
        </div>
      </div>
      <a href="/stores/{{$store->slug}}" target="_blank" class="btn btn-md btn-info btn-block text-white mt-4"><i class="fas fa-eye"></i> Preview Toko</a>
      <a href="/merchant-product" class="btn btn-md btn-primary btn-block text-white mt-1"><i class="fas fa-plus"></i> Tambah Produk</a>
    </section>
    @else
    <section class="padding-around" style="margin-top: 10px;">
      @if(!Auth::user()->telp)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Sebelum membuat toko, pastikan data profil terisi semua dan benar, <a href="/profile/{{Auth::user()->id}}/edit">Edit profil saya disini</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="padding-around text-center" style="margin-bottom: 30px;">
        <img src="{{asset('assets/images/shop-dark.png')}}" style="width: 100%; max-width: 200px; vertical-align: middle;" />
      </div>
      <a href="/merchant/create" class="btn btn-md btn-block btn-outline-primary"><i class="fas fa-plus"></i> Buat Toko Baru</a>
    </section>
    @endif
    <section class="padding-x">
      @if($store && $store->user->products)
      <div class="row">
        @foreach($products as $product)
        <div class="col-6 col-sm-6 col-md-4">
      		<div class="product-sm mb-3">
      			<div class="img-wrap">
              @if($store->status)
              <img src="{{ asset($product->thumbnailUrl()) }}">
              @else
              <img style="filter: grayscale(100%)" src="{{ asset($product->thumbnailUrl()) }}">
              @endif
            </div>
            <div class="row mt-2">
              <div class="col-6 col-sm-6">
                <form class="" action="{{ route('merchant-product.destroy', $product->id) }}" method="POST">
                  <input type="hidden" name="_method" value="delete">
                  @csrf
                  <button class="btn btn-outline-danger delete-confirm" data-name="{{ $product->name }}" type="submit" style="padding: 5px;">
                    <small><i class="fas fa-trash"></i> Hapus</small>
                  </button>
                </form>
              </div>
              <div class="col-6 col-sm-6 text-right">
                <a href="/merchant-product/{{$product->id}}/edit" class="btn btn-outline-secondary" style="padding: 5px;">
                  <small><i class="fas fa-pencil-alt"></i> Ubah</small>
                </a>
              </div>
            </div>

      			<div class="text-wrap">
      				<span class="text-truncate-multiple">{{$product->name}}</span>
              @if($product->discount)
              <span class="badge-danger small" style="border-radius: 3px; background-color: rgb(255, 234, 239); font-weight: bold; color: rgb(255, 92, 132); padding: 1px 4px;">{{$product->discount}}%</span>
              <span class="text-muted" style="font-size: 11px; text-decoration: line-through;">{{priceFormat($product->price)}}</span>
      				<div class="price pt-1"><span style="font-weight: bold;">{{priceFormat(calculateDiscount($product->price, $product->discount))}}</span></div>
              @else
              <div class="price pt-1"><span style="font-weight: bold;">{{priceFormat($product->price)}}</span></div>
              @endif
      			</div>
      		</div>
      	</div>
        @endforeach
      </div>
      @else
      @endif
    </section>
  </main>
  @include('includes.footer_navigation')
</div>
@endsection

@section('content_js')
<script type="text/javascript">
  $('.delete-confirm').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: 'Anda yakin menghapus "'+name+'" ?',
        text: "Jika anda menghapus data ini, anda akan menghapus data selamnya.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
    })
    .then((willDelete) => {
      if (willDelete.isConfirmed) {
        form.submit();
      }
    });
  });
</script>
@endsection
