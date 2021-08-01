@extends('layouts.app')

@section('content')
<!-- Fixed navbar -->
<div class="screen-wrap">
  <section class="padding-around" style="position: sticky; top: 0px; z-index: 5; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
  	<div class="row mw-mobile">
  		<div class="col-1 text-center" style="padding: 5px 5px 0 0;">
  			<a href="/login" class="btn-header">
  				<i class="fa fa-arrow-left"></i>
  			</a>
  		</div>
  		<div class="col text-center">
        <img style="width:6em;" src="{{asset('assets/images/bonjek.svg')}}">
  		</div>
      <div class="col-1 text-center">

  		</div>
  	</div>
  </section>
</div>


<main class="flex-shrink-0 mt-2 mw-mobile">
  <div class="container">
    <div class="login-box">
      <form method="POST" action="{{ route('register') }}">
      @csrf
        <div class="text-center pt-2 pb-2">
            <h5 class="text-dark">Daftar Akun</h5>
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">Nama</label>
          <input id="name" type="text" class="form-control floating-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">No. Handphone/WA</label>
          <input id="telp" type="text" class="form-control floating-input @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required autocomplete="telp" autofocus>
          @error('telp')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">Email</label>
          <input id="email" type="email" class="form-control floating-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">Password</label>
          <input id="password" type="password" class="form-control floating-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">Re-Password</label>
          <input id="password-confirm" type="password" class="form-control floating-input" name="password_confirmation" required autocomplete="new-password">
        </div>
        <!-- <div class="form-group my-4 text-secondary">
            By Clicking button below you are agree to
            the <a href="" class="link">Terms and Condition</a> of the app
        </div> -->
        <div class="mt-4 pt-2">
          <button type="submit" class="btn btn-block btn-primary btn-lg">Daftar</button>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection
