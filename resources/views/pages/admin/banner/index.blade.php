@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Banner Slider
			</h1>
		</div>

		<div class="row">
			<div class="col-xl-7 col-sm-12">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
            <div class="row no-gutters">
              <div class="col-12 text-right">
                <a class="btn btn-md btn-primary" href="{{route('admin.banners.create')}}">Add Banner</a>
              </div>
            </div>
					</div>
          <div class="table-responsive">
            <table class="table">
  						<thead class="bg-warning text-white">
  							<tr>
  								<th style="width:5%;">ID</th>
  								<th style="width:15%;">Title</th>
                  <th style="width:20%;">Image</th>
									<th style="width:15%;">Link</th>
                  <th>Status</th>
  								<th style="width:10%;">Actions</th>
  							</tr>
  						</thead>
  						<tbody>
  							@foreach ($banners as $banner)
  							<tr>
  								<td>{{$banner->id}}</td>
  								<td>{{$banner->title}}</td>
  								<td style="text-align: center;">
                    <img src="{{asset('storage/'.$banner->small)}}" style="max-height: 60px;" class="mr-2" alt="{{$banner->title}}">
                  </td>
									<td>{{$banner->link}}</td>
                  <td>
                    @if($banner->isPublished)
                		<a href="/admin/banners/off/{{$banner->id}}">
											<span class="btn btn-md btn-success">Active</span>
										</a>
                    @else
                  	<a href="/admin/banners/on/{{$banner->id}}">
											<span class="btn btn-md btn-light">Draft</span>
										</a>
                    @endif
                  </td>
  								<td class="table-action">
										<!-- <a href="#"><i class="align-middle fas fa-fw fa-pen"></i></a> -->
                    <a class="btn btn-md btn-danger delete-confirm" style="color: #fff;" href="/admin/banners/destroy/{{$banner->id}}"><i class="align-middle fa fa-trash"></i></a>
  								</td>
  							</tr>
  							@endforeach
  						</tbody>
  					</table>
          </div>
					<div class="d-flex">
					    <div class="mx-auto">
					        {{$banners->links("pagination::bootstrap-4")}}
					    </div>
					</div>
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

  $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'question',
        confirmButtonText: `Yes, Do it now`,
        denyButtonText: `No..`,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  });
</script>
@endsection
