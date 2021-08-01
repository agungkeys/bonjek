@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Master District
			</h1>
		</div>

		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
						<div class="form-group">
							<form action="/admin/master/district/store" method="post">
          			@csrf
                <div class="row">
                  <div class="col-md-4 col-sm-12 pt-2">
                    <!-- <input type="text" name="name" class="form-control" placeholder="Sub Category Name..."> -->
                    <select id="city" name="city" class="form-control">
											<option value="">Choose City...</option>
                      @foreach ($city as $ct)
                      <option value="{{$ct->id}}">{{$ct->name}}</option>
                      @endforeach
										</select>
                  </div>
                  <div class="col-md-4 col-sm-12 pt-2">
                    <div class="input-group input-group-md">
    									<input type="text" name="name" class="form-control capitalize" placeholder="District Name...">
    									<span class="input-group-append">
    										<button class="btn btn-primary" type="submit">Add</button>
    									</span>
    								</div>
                  </div>
                </div>
							</form>
						</div>
					</div>
          <div class="table-responsive">
            <table class="table">
  						<thead class="bg-warning text-white">
  							<tr>
  								<th scope="col" style="width:10%;">ID</th>
                  <th scope="col" style="width:25%;">City</th>
  								<th scope="col" style="width:40%;">District</th>
  								<th scope="col" style="width:10%;">Actions</th>
  							</tr>
  						</thead>
  						<tbody>
  							@foreach ($district as $dst)
  							<tr>
  								<td>{{$dst->id}}</td>
                  <td>{{$city->firstWhere('id',$dst->city_id)->name}}</td>
  								<td>{{$dst->name}}</td>
  								<td class="table-action">
  									<a class="btn btn-md btn-danger delete-confirm" style="color: #fff;" href="/admin/master/district/destroy/{{$dst->id}}"><i class="align-middle fa fa-trash"></i></a>
  								</td>
  							</tr>
  							@endforeach
  						</tbody>
  					</table>
          </div>

					<div class="d-flex">
					    <div class="mx-auto">
					        {{$district->links("pagination::bootstrap-4")}}
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
