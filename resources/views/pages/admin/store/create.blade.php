@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Create Store
			</h1>
		</div>

		<div class="row">
			<div class="col-12 col-xl-6">
				<div class="card">
          <form method="post" action="{{ route('admin.stores.store') }}" enctype="multipart/form-data">
            @csrf
  					<div class="card-body">
              <div class="form-group">
								<label class="form-label w-100">Upload Store Logo</label>
                <file-upload image=""></file-upload>
								<small class="form-text text-muted">Disarankan file gambar dengan extension .svg, .png, .jpeg/.jpg 😁 <br>Harap upload dengan ukuran 1:1</small>
							</div>

              <div class="form-group">
                <label>Store Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror capitalize" id="name" name="name" placeholder="Name">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

							<div class="form-group">
                <label>Slug</label>
                <input readonly type="text" class="form-control" id="slug" name="slug" >
							</div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description..."></textarea>
              </div>

              <div class="form-group">
                <label>Store Category</label>
                <select class="form-control @error('store_category_id') is-invalid @enderror" name="store_category_id" id="store_category_id">
                  <option value="0">- Choose Category -</option>
                  @foreach ($store_categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
								@error('store_category_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label>City</label>
                <select class="form-control" name="city_id" id="city_id">
                  @foreach ($store_cities as $city)
                  <option value="{{$city->id}}">{{$city->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>District</label>
                <select class="form-control @error('district_id') is-invalid @enderror" name="district_id" id="district_id">
                  <option value="0">- Choose District -</option>
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
                <label>Address</label>
                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address..."></textarea>
                @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label class="bold">Operational Hours</label>
                <div class="row">
                  <div class="col-md-3 col-sm-12 pb-3">
                    <label>Open: </label>
                    <input class="form-control @error('store_open') is-invalid @enderror" type="time" id="store_open" name="store_open" min="05:00" max="23:00" required>
										@error('store_open')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
                  </div>
                  <div class="col-md-3 col-sm-12 pb-3">
                    <label>Closed: </label>
                    <input class="form-control @error('store_close') is-invalid @enderror" type="time" id="store_close" name="store_close" min="05:00" max="23:00" required>
										@error('store_close')
		                  <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                  </span>
		                @enderror
                  </div>
                  <div class="col-md-5 col-sm-12 pb-3">
                    <label>Telp || Whatsapp</label>
                    <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" placeholder="6281200112233">
                    @error('telp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 text-right">
                  <a class="btn btn-md btn-grey" href="{{route('admin.stores')}}">Cancel</a>
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

	$('#name').focusout(function(){
		var value = $('#name').val();
		var slug = string_to_slug(value);
		$('#slug').val(slug);
	})
</script>
@endsection
