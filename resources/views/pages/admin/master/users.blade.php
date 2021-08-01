@extends('layouts.appadmin')

@section('content')
<main class="content">
	<div class="container-fluid">
		<div class="header">
			<h1 class="header-title" style="font-weight: 30;">
				Master Users
			</h1>
		</div>

		<div class="row">
			<div class="col-12">
				<!-- <div class="card flex-fill w-100">
				</div> -->
				<div class="card">
					<div class="card-header">
					</div>
          <div class="card-body">
            <table class="table data-table table-striped dataTable dtr-inline table-responsive" style="width: 100%;">
              <thead>
                <tr>
                  <th>No</th>
                  <th style="width: 20%;">Name</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Slug</th>
                  <th>Telp</th>
                  <th>Avatar</th>
                  <th>provider</th>

                  <th>created_at</th>
                  <th>updated_at</th>
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
</main>
@endsection
@section('foot_js')
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master_users.index') }}",
				order: [[ 0, "desc" ]],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'level', name: 'level'},
            {data: 'slug', name: 'slug'},
            {data: 'telp', name: 'telp'},
            {data: 'avatar', name: 'avatar'},
            {data: 'provider', name: 'provider'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          {
            "targets": [6],
            "visible": false,
            "searchable": false
          }
        ]
    });

  });
</script>
@endsection
