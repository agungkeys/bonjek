@extends('layouts.app')

@section('content')
<div class="screen-wrap">
  <section class="padding-around" style="position: sticky; top: 0px; z-index: 5; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
  	<div class="row mw-mobile">
  		<div class="col-1 text-center" style="padding: 5px 5px 0 0;">
  			<a href="/" class="btn-header">
  				<i class="fa fa-arrow-left"></i>
  			</a>
  		</div>
  		<div class="col text-center">
        <img style="width:6em;" src="{{asset('assets/images/bonjek.svg')}}">
        <h4>bonjek.id</h4>
  		</div>
      <div class="col-1 text-center">

  		</div>
  	</div>
  </section>
</div>
<main class="flex-shrink-0 mw-mobile">
  <div class="p-3 pt-2 pb-2">
    <div class="login-box">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center pt-2 pb-2">
            <h5 class="text-dark">Login</h5>
        </div>
        <!-- <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-block btn-outline-primary btn-lg"><img class="pr-1" style="width: 1.5em; margin-top: -3px" src="{{asset('assets/images/icons/facebook.svg')}}">Masuk dengan Facebook</a>
        <a href="{{ route('social.oauth', 'google') }}" class="btn btn-block btn-outline-success btn-lg"><img class="pr-1" style="width: 1.5em; margin-top: -3px" src="{{asset('assets/images/icons/google.svg')}}">Masuk dengan Google</a> -->

        <!-- <div class="text-center pt-4 pb-2">
          <h5 class="text-dark">atau</h5>
        </div> -->
        <div class="form-group floating-form-group">
          <label class="floating-label">Email Address</label>
          <input id="email" type="email" placeholder="email" class="form-control floating-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group floating-form-group">
          <label class="floating-label">Password</label>
          <input id="password" type="password" placeholder="password" class="form-control floating-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password'))
            <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <!-- <div class="form-group row my-4">
          <div class="col-md-6 offset-md-4">
            <div class="custom-control custom-switch">
              <input type="checkbox" id="remember" name="remember" class="custom-control-input" {{old('remember')?'checked':''}}>
              <label class="custom-control-label" for="remember">Ingat Saya</label>
            </div>
          </div>
        </div> -->
        <!-- <div class="form-group my-4">
            <a href="" class="link">Forget password?</a>
        </div> -->
        <button type="submit" class="btn btn-block btn-primary btn-lg">Masuk</button>
        <!-- <div class="mt-4 mb-4">
          <span>Belum punya akun? <a href="/register" class="text-primary">Ayo Daftar!</a></span>
        </div> -->
      </form>
    </div>
  </div>
</main>
@endsection
