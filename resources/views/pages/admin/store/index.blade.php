@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Store UMKM
			</h1>
		</div>

		<div class="row">
			<div class="col-xl-12">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
            <div class="row no-gutters">
              <div class="col-12 text-right">
                <a class="btn btn-md btn-primary" href="{{route('admin.stores.create')}}">Add Store</a>
              </div>
            </div>
					</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table table-striped dataTable dtr-inline table-responsive">
    						<thead class="bg-warning text-white">
    							<tr>
    								<th style="width:3%;">ID</th>
                    <th>Image</th>
                    <th style="width:10%;">Category</th>
    								<th style="width:15%;">Store Name</th>
                    <th style="width:13%;">Slug</th>
                    <th>All&nbsp;Products</th>
                    <th style="width:20%;">Description</th>
                    <th>City</th>
                    <th style="width:10%;">District</th>
                    <th style="width:15%;">Operational</th>
                    <th>Telp</th>
  									<th>Popular</th>
                    <th>Status</th>
                    <th>Action</th>
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
  const truncate = (str, max, suffix) => str.length < max ? str : `${str.substr(0, str.substr(0, max - suffix.length).lastIndexOf(' '))}${suffix}`;
  $('.capitalize').on('keyup', function () {
      $(this).capitalize();
  }).capitalize();

  function handleDelete(id){
		if(id){
			const url = `/admin/stores/destroy/${id}`;
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

  $(document).ready(function() {
    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('admin.stores') }}",
			order: [[ 0, "desc" ]],
      columns: [
        {data: 'id', name: 'id'},
        {
          data: function(datas){
						if(datas.logo){
							return `<img style="max-width: 4em;" src="/storage/${datas.logo}" class="mr-2" alt="${datas.name}">`;
						}else{
							return `<img style="max-width: 4em;" src="https://www.contec.com/-/media/contec/product/photo/no-image.jpg">`;
						}
          },
          name: 'logo'
        },
        {data: 'category', name: 'category'},
        {data: 'name', name: 'name'},
        {
          data: function(datas){
            return `<span>${truncate(datas.slug, 40, '...')}</span>`;
          },
          name: 'slug'
        },
        {
          data: function(datas){
            if(!!datas.count_products){
              return `<span style="text-align: center; font-weight: bold;">${datas.count_products}</span>`;
            }else{
              return `<span style="text-align: center;">-</span>`;
            }
          },
          name: 'count_products'
        },
        {
          data: function(datas){
            return `<span>${truncate(datas.description, 50, '...')}</span>`;
          },
          name: 'description'
        },
        {data: 'city', name: 'city'},
        {data: 'district', name: 'district'},
        {
          data: function(datas){
            return `<span>Buka: ${datas.open}, Tutup: ${datas.close}</span>`;
          },
          name: 'operational'
        },
        {data: 'telp', name: 'telp'},
        {
          data: function(datas){
            if(!!datas.popular){
              return `<span class="badge badge-pill badge-info">Order: ${datas.popular}</span>`;
            }else{
              return `<span class="badge badge-pill badge-light">Not set</span>`;
            }
          },
          name: 'popular'
        },
        {
          data: function(datas){
            if(!!datas.status){
              return `<a href="/admin/stores/off/${datas.id}"><span class="btn btn-md btn-success">Active</span></a>`;
            }else{
              return `<a href="/admin/stores/on/${datas.id}"><span class="btn btn-md btn-light">Draft</span></a>`;
            }
          },
          name: 'status'
        },
      ],
      columnDefs: [
        {
          "orderable": false,
			    "targets": [13],
			    "data": function (datas) {
						return '<div class="btn-group"><a class="btn btn-md btn-info" style="color: #fff;"><i class="fas fa-pencil-alt"></i></a><button class="btn btn-md btn-danger delete-confirm" onClick="handleDelete('+JSON.stringify(datas.id)+')" style="color: #fff;"><i class="align-middle fa fa-trash"></i></button></div>'
			    },
				}
      ]
    });
  });
</script>
@endsection
