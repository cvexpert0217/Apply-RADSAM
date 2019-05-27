<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keyword" content="">
	<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
	<title>APPLY RADSAM</title>

	<!-- Icons -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

	<!-- Main styles for this application -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<!-- Styles required by this views -->
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>

</head>
<!-- BODY options, add following classes to body to change options
'.header-fixed' - Fixed Header
'.brand-minimized' - Minimized brand (Only symbol)
'.sidebar-fixed' - Fixed Sidebar
'.sidebar-hidden' - Hidden Sidebar
'.sidebar-off-canvas' - Off Canvas Sidebar
'.sidebar-minimized'- Minimized Sidebar (Only icons)
'.sidebar-compact'    - Compact Sidebar
'.aside-menu-fixed' - Fixed Aside Menu
'.aside-menu-hidden'- Hidden Aside Menu
'.aside-menu-off-canvas' - Off Canvas Aside Menu
'.breadcrumb-fixed'- Fixed Breadcrumb
'.footer-fixed'- Fixed footer
-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
	@include('admin.navbar')

	<div class="app-body">
		@include('admin.sidebar')

		<!-- Main content -->
		<main class="main">

			<!-- Breadcrumb -->
			@include('admin.breadcrumb')

			@yield('content')
			<!-- /.container-fluid -->
		</main>

		@include('admin.asidemenu')

	</div>

	@include('panel.footer')
	@include('panel.scripts')
	@yield('myscript')

</body>
</html>