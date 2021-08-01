@extends('layouts.app')

@section('content')

<!-- menu main -->
<section class="padding-around text-center pt-2 pb-0">
  <h5 class="pt-2">Order Sukses</h5>
</section>
<section class="mw-mobile text-center mt-2">
  <img style="width: 8em;" src="{{asset('assets/images/checks.svg')}}" alt="">
</section>
<section class="text-center" style="margin-top: -2em; margin-left: -8px; margin-right: -8px;">
  <div class="mw-mobile">
    <img style="width: 100%; text-align: center;" src="{{asset('assets/images/shake-hands.png')}}" alt="">
  </div>
</section>

<section class="mw-mobile text-center mt-3" style="padding-bottom: 20em;">
  <div class="lead w-100"><h4>Selamat..!</h4></div>
  <div class="pl-4 pr-4"><span>Orderan anda berhasil dibuat dengan</span></div>
  <div class="text-center w-90 pt-3" style="display: inline-block;">
    <table class="text-left">
      <tr>
        <td>No. Transaksi&nbsp;&nbsp;</td>
        <td><b class="text-primary">: {{$orders[0]->invoice_id}}</b></td>
      </tr>
      <tr>
        <td>Total</td>
        <td><b>: {{priceFormat($orders[0]->total_price)}}</b></td>
      </tr>
    </table>
  </div>
  <div class="pt-2">
    <span class="badge badge-warning">#tetapdirumah</span>
    <span class="badge badge-warning">#jagajarak</span>
    <span class="badge badge-warning">#terapkan3m</span>
    <span class="badge badge-warning">#biarkamiyangantar</span>
    <span class="badge badge-warning">#umkmsejahtera</span>
  </div>
</section>

<section class="text-center nav-bottom" style="height: auto;">
  <div class="mw-mobile bg-primary w-100 pt-2" style="border-top-left-radius: 1.5em; border-top-right-radius: 1.5em;">
    <div id="choose-payment" style="padding: 0 .5em;">
      <span class="pt-2 pb-3 text-white">Pilih metode pembayaran</span>
      <div class="btn-group btn-group-block mt-2 mb-3" style="width: 100%;">
        <button class="btn btn-sm btn-secondary click-payment" data-value="CASH" style="width:50%;">Bayar Cash</button>
        <button class="btn btn-sm btn-success click-payment" data-value="TRANSFER" style="width:50%;">Bayar Transfer</button>
      </div>
    </div>
    <div id="payment-method" class="padding-around" style="display: none;">
      <div class="text-white pb-2">Total Pembelian Anda :<br>
        <input type="text" id="totalprice" name="totalprice" value="{{$orders[0]->total_price}}" style="position: fixed; top: -3em;" />
        <b class="lead">{{priceFormat($orders[0]->total_price)}}</b><br><a class="pl-2 badge badge-info text-white" onclick="copyPrice()" style="font-size: 11px; vertical-align: text-top;"><i class="far fa-copy"></i> copy total harga</a>
      </div>
      <div class="p-2" style="border: 1px solid #fff; border-radius: 1em;">
        <span class="badge badge-success text-white">Bayar dengan <b class="payment-value">{payment_value}</b></span>
        <div id="section-cash" class="pt-2 text-left" style="display: none;">
          <div class="form-group">
            <label class="text-white">Nominal Cash</label>
            <input type="text" class="form-control money" id="cash-nominal" name="cash-nominal" placeholder="100.000">
          </div>
          <span class="text-white" style="font-size: 12px; margin-top: -9px; display: block;">Silahkan input nominal cash yang akan anda bayarkan, agar memudahkan kurir kami untuk menyiapkan dana/uang kembalian anda.</span><br>
          <span class="text-white" style="font-size: 12px;">Seluruh pesanan dan pembayaran akan dilakukan konfirmasi menggunakan chat whatsapp, melalui link '<b style="font-weight: 800">Konfirmasi Pesanan<b>' dibawah.</span>
        </div>

        <div id="section-transfer" class="pt-2" style="display: none;">
          <div class="mb-1">
            <span class="text-white text-center">Silahkan transfer ke:<span>
          </div>
          <div class="mb-3">
            <input type="text" id="accountnumber" name="accountnumber" value="0017052870" style="position: fixed; top: -3em;" />
            <span class="text-white text-center"><b>0017052870<b> a/n. Salwah Nur<br>Bank Kaltim (Kode Bank 124)</span>
            <br><a class="pl-2 badge badge-info text-white" onclick="copyAccountNumber()" style="font-size: 11px; vertical-align: text-top;"><i class="far fa-copy"></i> copy nomor rekening</a>
          </div>
          <div class="text-left">
            <span class="text-white" style="font-size: 12px;"><div>Harap lakukan konfirmasi total pembayaran sebelum transfer pembayaran.</div><br>Seluruh pesanan dan pembayaran akan dilakukan konfirmasi menggunakan chat whatsapp, melalui link '<b style="font-weight: 800">Konfirmasi Pesanan<b>' dibawah.</span>
          </div>
        </div>
      </div>
    </div>
    <input name="name" value="{{Auth::user()->name}}" hidden />
    <input name="phone" value="{{Auth::user()->telp}}" hidden />
    <input name="address" value="{{Auth::user()->profile->address}}" hidden />
    <input name="district" value="{{Auth::user()->profile->district->name}}" hidden />
    <input name="shipping" value="{{$orders[0]->shipping_charge}}" hidden />
    <input name="admin_fee" value="{{$orders[0]->admin_fee}}" hidden />
    <input name="total" value="{{$orders[0]->total_price}}" hidden />
    <div id="btn-confirmation" class="w-100 mt-3" style="display: none;">
      <button id="btn-order-confirmation" class="btn btn-md btn-block btn-success ml-2 mr-2">Konfirmasi Pesanan</button>
    </div>
    <div id="btn-back-home" class="w-100 mt-1" style="display: none;">
      <a href="/stores" class="btn btn-md btn-block btn-danger ml-2 mr-2">Kembali ke Beranda</a>
    </div>
  </div>
</section>

@endsection
