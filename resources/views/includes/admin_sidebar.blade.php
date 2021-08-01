<nav id="sidebar" class="sidebar">
	<span class="sidebar-brand">
		<!-- <svg>
			<use xlink:href="#ion-ios-pulse-strong"></use>
		</svg> -->
		Bonjek Administrator
	</span>
	<div class="sidebar-content">
		<div class="sidebar-user">
			<img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/img/icons/profile-user.svg') }}" class="img-fluid rounded-circle mb-2" alt="{{Auth::user()->name}}" />
			<div class="font-weight-bold">{{Auth::user()->name}}</div>
			<small>{{Auth::user()->level}}</small>
		</div>

		<ul class="sidebar-nav">
			<li class="sidebar-item">
				<a href="/admin/dashboard" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>
				</a>
			</li>
			<li class="sidebar-header">
				Master
			</li>
			<li class="sidebar-item">
				<a href="#master-article" data-toggle="collapse" class="sidebar-link collapsed">
					<i class="align-middle mr-2 fas fa-fw fa-table"></i> <span class="align-middle">Master</span>
				</a>
				<ul id="master-article" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
					<li class="sidebar-header">
						Master General
					</li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.categories')}}">Master Categories</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.tags')}}">Master Tags</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.users')}}">Master Users</a></li>
					<li class="sidebar-header">
						Master Store
					</li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.store.categories')}}">M. Store Categories</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.product.categories')}}">M. Product Categories</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.product.sub.categories')}}">M. Product Sub Categories</a></li>
					<li class="sidebar-header">
						Master Location
					</li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.city')}}">Master City</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.district')}}">Master District</a></li>
					<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.master.location-charge')}}">Mapping Location Charges</a></li>
				</ul>
			</li>
			<li class="sidebar-header">
				General
			</li>
			<li class="sidebar-item">
				<a href="{{route('admin.banners')}}" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-money-check"></i> <span class="align-middle">Banners</span>
				</a>
			</li>
			<!-- <li class="sidebar-item">
				<a href="" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-newspaper"></i> <span class="align-middle">Articles</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a href="" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-swatchbook"></i> <span class="align-middle">Events</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a href="" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-ticket-alt"></i> <span class="align-middle">Event Attendance</span>
				</a>
			</li> -->
			<li class="sidebar-header">
				Stores
			</li>
			<li class="sidebar-item">
				<a href="{{route('admin.stores')}}" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-store"></i> <span class="align-middle">Store</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a href="" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-shopping-bag"></i> <span class="align-middle">Store Items</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a href="" class="sidebar-link">
					<i class="align-middle mr-2 fas fa-fw fa-shopping-basket"></i> <span class="align-middle">Transaction</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
