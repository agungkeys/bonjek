@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Mapping Location Charges
			</h1>
		</div>

		<div class="row">
			<div class="col-xl-12 col-xxl-12">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
						<div class="form-group">
							<form action="/admin/master/location-charge/store" method="post">
          			@csrf
                <div class="row">
                  <div class="col-md-2 col-sm-12 pt-2">
                    <!-- <input type="text" name="name" class="form-control" placeholder="Sub Category Name..."> -->
                    <select id="city" name="city" class="form-control">
											<option value="">Choose City...</option>
                      @foreach ($city as $ct)
                      <option value="{{$ct->id}}">{{$ct->name}}</option>
                      @endforeach
										</select>
                  </div>
                  <div class="col-md-2 col-sm-12 pt-2">
                    <select id="origin" name="origin" class="form-control">
											<option value="">Choose Origin...</option>
                      @foreach ($district as $dstrct)
                      <option value="{{$dstrct->id}}">{{$dstrct->name}}</option>
                      @endforeach
										</select>
                  </div>
                  <div class="col-md-2 col-sm-12 pt-2">
                    <select id="destination" name="destination" class="form-control">
											<option value="">Choose Destination...</option>
                      @foreach ($district as $dstrct)
                      <option value="{{$dstrct->id}}">{{$dstrct->name}}</option>
                      @endforeach
										</select>
                  </div>
                  <div class="col-md-2 col-sm-12 pt-2">
  									<input id="price" type="number" name="price" class="form-control" placeholder="Price">
                  </div>
                  <div class="col-md-2 col-sm-12 pt-2">
                    <button class="btn btn-primary" type="submit">Add Mapping</button>
                  </div>
                </div>
							</form>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table data-table table-striped dataTable dtr-inline table-responsive" style="width: 100%;">
	              <thead class="bg-warning text-white">
	                <tr>
	                  <th style="width: 10%">ID</th>
	                  <th style="width: 25%">City</th>
	                  <th style="width: 25%">Origin</th>
	                  <th style="width: 25%">Destination</th>
	                  <th style="width: 15%">Price</th>
										<th style="width: 10%">Action</th>
	                </tr>
	              </thead>
	              <tbody>
	              </tbody>
	            </table>
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

	function handleDelete(id){
		if(id){
			const url = `/admin/master/location-charge/destroy/${id}`;
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
		}
	}

	$(document ).ready(function() {
		$(function () {
	    var table = $('.data-table').DataTable({
	        processing: true,
	        serverSide: true,
	        ajax: "{{ route('admin.master.location-charge') }}",
					order: [[ 0, "asc" ]],
	        columns: [
            {data: 'id', name: 'district_shipping_charges.id'},
            {data: 'city', name: 'city'},
            {data: 'origin', name: 'origin'},
            {data: 'destination', name: 'destination'},
	        ],
					columnDefs: [
						{
					    "targets": [4],
					    "data": function (datas) {
								return '<span>'+formatRupiah(datas.price)+'</span>'
								// return '<button class="btn btn-md btn-danger delete-confirm" onClick="handleDelete('+JSON.stringify(datas.id)+')" style="color: #fff;"><i class="align-middle fa fa-trash"></i></button>'
					    },
						},
						{
							"orderable": false,
					    "targets": [5],
					    "data": function (datas) {
								return '<button class="btn btn-md btn-danger delete-confirm" onClick="handleDelete('+JSON.stringify(datas.id)+')" style="color: #fff;"><i class="align-middle fa fa-trash"></i></button>'
					    }
						}
					]
	    });
	  });
	});
</script>
@endsection
