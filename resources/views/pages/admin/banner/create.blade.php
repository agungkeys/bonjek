@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Create Banner
			</h1>
		</div>

		<div class="row">
			<div class="col-12 col-xl-6">
				<div class="card">
          <form method="post" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
            @csrf
  					<div class="card-body">
							<div class="form-group">
								<label class="form-label">Title Banner</label>
								<input class="form-control @error('title') is-invalid @enderror capitalize" id="title" name="title">
							</div>
              <div class="form-group">
								<label class="form-label">Link</label>
								<input class="form-control @error('link') is-invalid @enderror" id="link" name="link">
							</div>
							<div class="form-group">
								<label class="form-label w-100">Upload Image Banner</label>
                <file-upload class="@error('image') is-invalid @enderror" id="image" name="image" image=""></file-upload>
								<small class="form-text text-muted">Disarankan file gambar dengan extension .svg 😁 <br>Harap upload dengan ukuran size max. 2mb dan <br>Resolusi gambar w: 1800px, h:700px.</small>
							</div>
							<div class="row">
                <div class="col-7"></div>
                <div class="col-5 text-right">
                  <a class="btn btn-md btn-grey" href="{{route('admin.banners')}}">Cancel</a>
                  <button type="submit" class="btn btn-md btn-primary">Save</button>
                </div>
              </div>
  					</div>
          </form>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
@section('content_js')
<script type="text/javascript">
  $('.capitalize').on('keyup', function () {
      $(this).capitalize();
  }).capitalize();
</script>
@endsection
