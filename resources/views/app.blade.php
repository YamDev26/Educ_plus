
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
	<!--plugins-->
	<link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}">
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
  @yield('link')
</head>
<body class="bg-theme bg-theme2">
	<!-- Le conteneur du loader -->
    <div id="loader">
      <div class="spinner-grow" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
	<div class="wrapper">
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">{{ config('app.name') }}</h4>
				</div>
				<div class="toggle-icon ms-auto">
					<i class="fadeIn animated bx bx-menu-alt-left"></i>
				</div>
			 </div>
			@include('includes._navbar')
		</div>
		<header>
			@include('includes._header')
		</header>
		<div class="page-wrapper">
			@yield('content')
		</div>
	</div>

	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
  @yield('script')
	<script>
		$(document).ready(function() {
			$('#Transaction-History').DataTable({
				lengthMenu: [[10, 20, -1], [10, 20, 'Todos']]
			});
		});
	</script>
	<script src="{{ asset('assets/js/index.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script>
		new PerfectScrollbar('.product-list');
		new PerfectScrollbar('.customers-list');
	</script>
</body>
</html>