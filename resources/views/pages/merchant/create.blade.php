@extends('layouts.app')

@section('content')
<!-- Begin page content -->
<div class="screen-wrap">
  <header class="app-header bg-primary" style="margin-left: -8px; margin-right: -8px; position: fixed; top: 0;">
    <div class="mw-mobile" style="width: 100%; display: flex; -webkit-box-pack: justify; justify-content: space-between;">
      <div class="row">
        <a href="/merchant" class="btn-header">
          <i class="fa fa-arrow-left"></i>
        </a>
        <span class="text-white lead" style="padding: 2px"><strong>Tambah Toko</strong></span>
      </div>
      <div>
        <a href="/logout" class="btn-header">Keluar</a>
      </div>
    </div>
  </header> <!-- section-header.// -->

  <main class="app-content mw-mobile">
    <section class="padding-x pb-3 bg-primary text-white" style="margin-left: -8px; margin-right: -8px; margin-top: 60px;">
    	<figure class="icontext align-items-center mr-4" style="max-width: 300px;">
    		<!--<div class="icon icon-md rounded-circle profile-pic" style="background-image: url('{{ Auth::user()->profile ? Auth::user()->profile->img : Auth::user()->avatar }}')"></div>-->
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
      <form method="post" action="{{ route('merchant.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
          <label for="name" class="col-12 col-form-label">Logo Toko</label>
          <div class="icontext">
            <div class="icon">
              <file-upload image=""></file-upload>
            </div>
            <div class="text">
              <span class="text-muted">*harap upload dengan ukuran square (1:1)</span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Nama Toko</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="description" id="description" class="form-control" placeholder="Deskripsi"></textarea>
        </div>

        <div class="form-group">
          <label>Kategori Toko</label>
          <select class="form-control" name="store_category_id" id="store_category_id">
            <option value="0">- Pilih Kategori -</option>
            @foreach ($store_categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Kota</label>
          <select class="form-control" name="city_id" id="city_id">
            @foreach ($store_cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Wilayah</label>
          <select class="form-control @error('district_id') is-invalid @enderror" name="district_id" id="district_id">
            <option value="0">- Pilih Kelurahan -</option>
            @foreach ($store_districts as $district)
            <option value="{{$district->id}}">{{$district->name}}</option>
            @endforeach
          </select>
          @error('district_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat"></textarea>
          @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Jam Operasional Harian</label>
          <div class="row">
            <div class="col-4">
              <label>Buka: </label>
              <input type="text" class="form-control" id="store_open" name="store_open" placeholder="08:00">
            </div>
            <div class="col-1"></div>
            <div class="col-4">
              <label>Tutup: </label>
              <input type="text" class="form-control" id="store_close" name="store_close" placeholder="21:00">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Telp/ Whatsapp</label>
          <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" placeholder="Diutamakan No Whatsapp">
          @error('telp')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group pt-2">
          <button type="submit" class="btn btn-block btn-primary btn-flat float-right">Simpan</button>
        </div>
      </form>
    </section>
  </main>
  @include('includes.footer_navigation')
</div>
@endsection

@section('content_js')
  <script type="text/javascript">
    $('#store_open').mask('00:00');
    $('#store_close').mask('00:00');
  </script>
@endsection
