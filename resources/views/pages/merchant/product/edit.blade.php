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
        <span class="text-white lead" style="padding: 2px"><strong>Ubah Produk</strong></span>
      </div>
      <div>
        <a href="/logout" class="btn-header">Keluar</a>
      </div>
    </div>
  </header>
  <!-- section-header.// -->

  <main class="app-content mw-mobile">
    <section class="padding-x pb-3 bg-primary text-white" style="margin-left: -8px; margin-right: -8px; margin-top: 60px;">
    	<figure class="icontext align-items-center mr-4" style="max-width: 300px;">
    		<!--<img class="icon icon-md rounded-circle" src="{{ Auth::user()->profile ? asset(Auth::user()->profile->img) : Auth::user()->avatar }}">-->
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
      <form method="post" action="{{ route('merchant-product.update', $product->slug) }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        @csrf
        <div class="form-group">
          <label for="name" class="col-12 col-form-label">Gambar Produk
            <button type="button" class="btn btn-sm" data-toggle="popover" data-placement="top" title="Kendala Upload Gambar?" data-content="Anda mengalami kendala dalam mengupload gambar?, 1. Lakukan dengan mengupload gambar lain terlebih dahulu, 2. Re-upload kembali dengan gambar yang anda inginkan, 3. Tunggu sampai gambar benar-benar muncul didalam box, 4. Jika belum berhasil lakukan poin '1' kembali."><i class="far fa-question-circle text-warning"></i></button>
            <a href="/merchant-product/{{$product->id}}/edit" class="btn btn-sm text-primary" style="right: 0px; position: absolute;">
              <i class="fas fa-sync"></i> Refresh
            </a>
          </label>
          <file-upload-multiple images="{{ $product->images }}"></file-upload-multiple>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control @error('product_category_id') is-invalid @enderror" name="product_category_id" id="product_category_id">
                <option value="">- Pilih Kategori -</option>
                @foreach ($product_categories as $category)
                <option value="{{$category->id}}" {{ $category->id == $product->product_category_id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
              </select>
              @error('product_category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Sub-Kategori</label>
              <select class="form-control @error('product_sub_category_id') is-invalid @enderror" name="product_sub_category_id" id="product_sub_category_id"></select>
              @error('product_sub_category_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <label>Slug</label>
          <input readonly type="text" value="{{ $product->slug }}" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" placeholder="Slug">
        </div>

        <div class="form-group">
          <label>Deskripsi</label>
          <textarea rows=3 name="description" id="description" class="form-control" placeholder="Deskripsi">{{ $product->description }}</textarea>
        </div>

        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label>Harga</label>
              <input type="text" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror money" id="price" name="price" placeholder="Price">
              @error('price')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <label>Diskon</label>
              <input type="text" value="{{ $product->discount }}" class="form-control @error('discount') is-invalid @enderror percent" id="discount" name="discount" placeholder="(%)">
              @error('discount')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="col-3">
            <div class="form-group">
              <label>Stok</label>
              <input type="number" value="{{ $product->stock }}" class="form-control" id="stock" name="stock" placeholder="0">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label>Berat Produk</label>
              <div class="row">
                <div class="col-5">
                  <select class="form-control" name="weight_variant" id="weight_variant">
                    <option value="g" {{ 'g' == $product->weight_variant ? 'selected' : '' }}>Gram (g)</option>
                    <option value="kg" {{ 'kg' == $product->weight_variant ? 'selected' : '' }}>Kilogram (kg)</option>
                  </select>
                </div>
                <div class="col-4">
                  <input type="number" value="{{ $product->weight }}" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" placeholder="0">
                  @error('weight')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>
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
  $(document).ready(function() {
    // Initial data sub-category
    setTimeout(function(){
      // var catId = $("#product_category_id").val();
      $.ajax({
        url:"{{ route('subcat') }}",
        type: "POST",
        data: {
          cat_id: '{{$product->product_category_id}}'
        },
        success:function (data) {
          $('#product_sub_category_id').empty();
          data.subcategories.unshift({id: '', name: '- Pilih Sub Kategori -'})
          $.map(data.subcategories, function(item, idx) {
            $('#product_sub_category_id').append('<option value="'+item.id+'">'+item.name+'</option>');
          })
         }
       });
       // set data sub-cetgory selected
       setTimeout(function(){
         $("#product_sub_category_id").val("{{$product->product_sub_category_id}}");
       },1000)
    }, 1000);
  });

  $('#product_category_id').on('change',function(e) {
    var cat_id = e.target.value;
    $.ajax({
      url:"{{ route('subcat') }}",
      type:"POST",
      data: {
        cat_id
      },
      success:function (data) {
        $('#product_sub_category_id').empty();
        data.subcategories.unshift({id: '', name: '- Pilih Sub Kategori -'})
        $.map(data.subcategories, function(item, idx) {
          $('#product_sub_category_id').append('<option value="'+item.id+'">'+item.name+'</option>');
        })
       }
     })
  });

  // untuk remove notification input ketika error
  $('form input[type=text]').focus(function(){
    // get selected input error container
    $(this).siblings(".invalid-feedback").hide();
    $(this).removeClass("is-invalid");
  });

  // untuk remove notification select ketika error
  $('form select').focus(function(){
    // get selected input error container
    $(this).siblings(".invalid-feedback").hide();
    $(this).removeClass("is-invalid");
  });
</script>
@endsection
