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
          <a class="nav-link" id="profile-tab" href="/profile/{{Auth::user()->id}}/edit" aria-selected="false">Profil</a>
        </li>
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link" id="profile-detail-tab" href="/profile-detail" aria-selected="true">Detil Profil</a>
        </li>
        <li class="nav-item waves-effect waves-light">
          <a class="nav-link active" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">Password</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="password" role="tabpanel" aria-labelledby="password-tab">
          <form class="pt-3" method="post" action="{{ route('profile-password.update', Auth::user()->id) }}" >
            <input type="hidden" name="_method" value="put">
            @csrf

            <div class="form-group">
              <label>Password Lama</label>
              <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Input Password Lama">
              @error('old_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="Password Baru">
              @error('new_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label>Ulangi Password Baru</label>
              <input type="password" class="form-control @error('renew_password') is-invalid @enderror" id="renew_password" name="renew_password" placeholder="Ulangi Password Baru">
              @error('renew_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
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
