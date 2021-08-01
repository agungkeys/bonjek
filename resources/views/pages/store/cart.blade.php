@extends('layouts.app')

@section('title', 'Keranjang Belanja TokoKita by Ruang Kita | Ruang Kebaikan')
@section('meta_keywords', 'keranjang belanja, toko kita, umkm, umkm bontang, list umkm bontang, daftar umkm bontang')
@section('meta_description', 'Keranjang Belanja  TokoKita/UMKM Kota Bontang, Pemberdayaan Ekonomi Kreatif Kota Bontang')

@section('content')

@include('includes.header_store_cart')
<div id="cart">
  <section class="padding-around mt-3 mw-mobile">
    <div class="card">
      <div class="card-header">
        <b>Daftar Item Pesanan</b>
      </div>
      <div class="card-body">
        <div class="cart-content-items-list"></div>
        <figure class="icontext w-100 mt-3 pt-3" style="border-top: 1px solid #eee;">
        	<div class="icon">
            <img src="https://img.icons8.com/bubbles/344/short-hair-lady-question-mark.png" style="background: none; width: 75px; height: 75px;" alt="">
          </div>
        	<figcaption class="text">
            <p>Butuh produk yang lainnya ?</p>
            <a class="btn btn-sm btn-block btn-outline-primary mt-2 add-more-product" href=""><i style="font-size: 13px;" class="fa fa-plus"></i> Tambah Item</a>
          </figcaption>
        </figure>
      </div>
    </div>
  </section>

  <section class="padding-around mt-2 mw-mobile">
    <div class="card">
      <div class="card-header">
        Data Pemesan
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-5 pb-1">
            Nama
          </div>
          <div class="col-7 pb-1">

          </div>
          <div class="col-5 pb-1">
            Nomor HP (WA)
          </div>
          <div class="col-7 pb-1">

          </div>
          <div class="col-5 pb-1">
            Alamat Lengkap
          </div>
          <div class="col-7 pb-1">

          </div>
          <div class="col-5 pb-1">
            Kelurahan
          </div>
          <div class="col-7 pb-1">

          </div>
          <div class="col-5 pb-1">
            Kota
          </div>
          <div class="col-7 pb-1">

          </div>
          <!-- <div class="col-5 pb-1">
            Catatan
          </div>
          <div class="col-7 pb-1">
            <textarea name="notes" id="notes" class="form-control" placeholder="Catatan untuk toko" rows=3></textarea>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <section class="padding-around mt-2 mw-mobile">
    <div class="card">
      <div class="card-header">
        <b>Ringkasan Pembayaran</b>
      </div>
      <div class="card-body">
        <div class="cart-content-detail-list"></div>
      </div>
    </div>
  </section>

  <section class="padding-around mt-2 mw-mobile">
    <button id="submit-cart" class="btn btn-block btn-primary" disabled>Pesan Sekarang</button>
  </section>

</div>

<script type="text/html" id="template-productcart">
  <div class="row item-cart pb-0">
    <div class="col-4 col-md-3 pb-3">
      <div class="item">
        <div class="product-sm">
          <div class="image img-wrap" style="height: 95px;">
            <img src="public/{item_image}">
          </div>
        </div>
      </div>
    </div>
    <div class="col-8 col-md-9">
      <div class="text-wrap">
        <div class="text-truncate-multiple text-muted">{item_name}</div>
        <div class="price pt-1"><span class="pricing" style="font-weight: 800;">{item_price}</span></div>
      </div>
      <div class="row text-right">
        <div class="col-4 col-md-6"></div>
        <div class="col-8 col-md-6">
          <div class="input-group input-group-sm pb-2 input-spinner qty qty-selector clear" style="width: 100%; display: flex;" data-item-id="{item_id}">
            <div class="input-group-prepend">
              <button class="btn btn-light minus cart-button-qty" type="button" data-qty-action="minus"> <i class="fa fa-minus"></i> </button>
            </div>
            <input readonly type="number" class="form-control" min="0" value="{item_qty}" name="qty" style="width: 100%; max-width: 100%; flex-basis: auto;">
            <div class="input-group-append">
              <button class="btn btn-light plus cart-button-qty" type="button" data-qty-action="plus"> <i class="fa fa-plus"></i> </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</script>
<script type="text/html" id="template-detail">
  <div class="row">
    <div class="col-12 pb-1">
      <span>Harga</span>
      <span style="float: right;" class="text-muted">{subtotal}</span>
    </div>
    <div class="col-12 pb-1" style="background: #f2f5ff; border-radius: .5em;">
      <input id="f_origin_id" class="f_origin_id" name="f_origin_id" hidden value="{f_origin_id}" />
      <input id="f_destination_id" class="f_destination_id" name="f_destination_id" hidden value="" />
      <input id="f_customer_id" class="f_customer_id" name="f_customer_id" hidden value="" />
      <input id="f_district_shipping_id" class="f_district_shipping_id" name="f_district_shipping_id" hidden value="{f_district_shipping_id}" />
      <input id="f_shipping_charge" class="f_shipping_charge" name="f_shipping_charge" hidden value="{f_shipping_charge}" />
      <input id="f_admin_fee" class="f_admin_fee" name="f_admin_fee" hidden value="{f_admin_fee}" />
      <input id="f_total_price" class="f_total_price" name="f_total_price" hidden value="{f_total_price}" />

      <span>Perkiraan Biaya Kirim</span>
      <span class="ongkir text-muted" style="float: right; position: relative; top: calc(-.6em);">{ongkir}</span>
    </div>
    <div class="col-12">
      <span>Biaya Admin</span>
      <span class="text-muted" style="float: right;">{admin_fee}</span>
    </div>
    <div class="col-12 pt-2">
      <span>Total Harga</span>
      <span class="total" style="float: right; font-weight: 800;">{total}</span>
    </div>
  </div>
</script>
@endsection
