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
        <span class="text-white lead" style="padding: 2px"><strong>Ubah Profil</strong></span>
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
          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profil</a>
        </li>
        <li class="nav-item waves-effect waves-light">
            @if(!empty($url))
                <a class="nav-link" id="profile-detail-tab" href="/profile-detail/create?{{$url}}" aria-selected="true">Detil Profil</a>
            @else
                <a class="nav-link" id="profile-detail-tab" href="/profile-detail" aria-selected="true">Detil Profil</a>
            @endif
        </li>
        @if(!Auth::user()->provider)
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link" id="password-tab" href="/profile-password" aria-selected="false">Password</a>
        </li>
        @endif
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <form class="pt-3" method="post" action="{{ route('profile.update', Auth::user()->id) }}" >
            <input type="hidden" name="_method" value="put">
            @csrf
            @if(!empty($url))<input hidden value="{{ $url }}"  id="url" name="url">@endif
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" value="{{ Auth::user()->email }}" class="form-control" id="email" name="email" disabled>
            </div>

            <div class="form-group">
              <label>Telp / Whatsapp (0812xxxxxxxx)</label>
              <input type="number" value="{{ Auth::user()->telp }}" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" placeholder="Contoh: 081212341234">
              @error('telp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Registrasi</label>
              <input type="text" value="{{ Auth::user()->created_at->format('d F Y') }}" class="form-control" id="create_at" name="create_at" disabled>
            </div>

            <button type="submit" class="btn btn-block btn-primary btn-flat float-right">Simpan Perubahan</button>

          </form>
        </div>
      </div>
    </section>
  </main>
  @include('includes.footer_navigation')
</div>
@endsection
