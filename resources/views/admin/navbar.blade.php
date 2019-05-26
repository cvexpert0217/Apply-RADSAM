<header class="app-header navbar">
	<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="logo" href="#">
		<img src="{{ asset('img/favicon.png') }}" class="logo-icon">
		<span class="logo-span">
			APPLY RADSAM
		</span>
	</a>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
		<span class="navbar-toggler-icon"></span>
	</button>

{{--	<div class="input-icon">--}}
{{--		<i class="fa fa-search"></i>--}}
{{--		<input type="text" class="form-control" placeholder="Type any cryptocurrency">--}}
{{--	</div>--}}

	<ul class="nav navbar-nav d-md-down-none">
		{{-- 
		<li class="nav-item px-3">
			<a class="nav-link" href="/">Dashboard</a>
		</li> 
		--}}
		<li class="nav-item px-3">
			<!-- <a class="nav-link" href="/sample/dashboard">Samples</a> -->
		</li>
	</ul>
	<ul class="nav navbar-nav ml-auto" style="padding-right: 20px;">
    
		<li class="nav-item dropdown">
			<a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img src="{{ asset('img/avatars/6.jpg') }}" class="img-avatar" alt="admin@bootstrapmaster.com">
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-header text-center">
					<strong>Admin's Account</strong>
				</div>
				{{--
					<a class="dropdown-item" href="#"><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></a>
					<div class="dropdown-header text-center">
						<strong>Settings</strong>
					</div>
					<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
					<a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
					<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="badge badge-secondary">42</span></a>
					<a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></a>
					<div class="divider"></div>
						<a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Lock Account</a>
				 --}}        
				<a class="dropdown-item" href="{{ route('logout') }}" 
					onclick="event.preventDefault(); 
					document.getElementById('logout-form').submit();">
					<i class="fa fa-lock"></i> Logout </a>
			</div>
		</li>
		<li class="nav-item d-md-down-none">
			<a class="nav-link" href="#"><i class="icon-settings"></i></a>
		</li>
		<li class="nav-item d-md-down-none">
			<a class="nav-link" href="/inbox"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
		</li>
	</ul>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	   {{ csrf_field() }}
   </form>
</header>
