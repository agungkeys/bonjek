@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Master City
			</h1>
		</div>

		<div class="row">
			<div class="col-xl-6 col-xxl-7">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
						<div class="form-group">
							<form action="/admin/master/city/store" method="post">
                			@csrf
								<div class="input-group input-group-md">
									<input type="text" name="name" class="form-control capitalize" placeholder="City Name...">
									<span class="input-group-append">
										<button class="btn btn-primary" type="submit">Add City</button>
									</span>
								</div>
							</form>
						</div>
					</div>
					<table class="table">
						<thead class="bg-warning text-white">
							<tr>
								<th style="width:10%;">ID</th>
								<th>City Name</th>
								<th style="width:10%;">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cities as $ct)
							<tr>
								<td>{{$ct->id}}</td>
								<td>{{$ct->name}}</td>
								<td class="table-action">
									<a class="btn btn-md btn-danger delete-confirm" style="color: #fff;" href="/admin/master/city/destroy/{{$ct->id}}"><i class="align-middle fa fa-trash"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="d-flex">
					    <div class="mx-auto">
					        {{$cities->links("pagination::bootstrap-4")}}
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
