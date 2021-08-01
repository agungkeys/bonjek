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
        <span class="text-white lead" style="padding: 2px"><strong>Ubah Profil Detail</strong></span>
      </div>
      <div>
        <a href="/logout" class="btn-header">Keluar</a>
      </div>
    </div>
  </header>

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

    <section class="pt-3" style="margin-bottom: 5em;">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link" id="profile-tab" href="/profile/{{Auth::user()->id}}/edit" aria-selected="false">Profil</a>
        </li>
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link active" id="profile-detail-tab" aria-selected="true">Detil Profil</a>
        </li>
        @if(!Auth::user()->provider)
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link" id="password-tab" href="/profile-password" aria-selected="false">Password</a>
        </li>
        @endif
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="profile-detail" role="tabpanel" aria-labelledby="profile-detail-tab">
          <form method="post" action="{{ route('profile-detail.update', Auth::user()->id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="put">
            @csrf
            @if(!empty($url))<input hidden value="{{ $url }}"  id="url" name="url">@endif
            <div class="form-group row">
              <label for="name" class="col-12 col-form-label">Gambar Profil</label>
              <div class="icontext">
                <div class="icon">
                  <file-upload image="{{ asset($profile->img) }}"></file-upload>
                </div>
                <div class="text">
                  <span class="text-muted">*ganti gambar profil, harap upload dengan ukuran square (1:1)</span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Bio</label>
              <input type="text" value="{{ $profile->bio }}" name="bio" id="bio" class="form-control" placeholder="Biografi"></input>
            </div>

            <div class="form-group">
              <label>Kota</label>
              <select class="form-control" name="city_id" id="city_id">
                @foreach ($cities as $city)
                <option value="{{$city->id}}" {{ $city->id == $profile->city_id ? 'selected' : '' }}>{{$city->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Wilayah</label>
              <select value="{{ $profile->district_id }}" class="form-control @error('district_id') is-invalid @enderror" name="district_id" id="district_id">
                <option value="0">- Pilih Kelurahan -</option>
                @foreach ($districts as $district)
                <option value="{{$district->id}}" {{ $district->id == $profile->district_id ? 'selected' : '' }}>{{$district->name}}</option>
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
              <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Alamat">{{ $profile->address }}</textarea>
              @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group pt-2">
              <button type="submit" class="btn btn-block btn-primary btn-flat float-right">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>

    </section>


  </main>
  @include('includes.footer_navigation')
</div>

@endsection
