<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="CoreUI Bootstrap 4 Admin Template">
	<meta name="author" content="Lukasz Holeczek">
	<meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
	<!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

	<title>APPLY RADASM</title>

	<!-- Icons -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	<!-- Main styles for this application -->

	<!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card mx-4">
					<div class="card-body p-4">
						<h1>Register</h1>
						
						<?php if (!empty($msg_code) && $msg_code == 'register_success') { ?>
							<p class="text-muted"><?= __('message.'.$msg_code) ?></p>
							
							<a href="{{ route('login') }}" class="btn btn-block btn-secondary mt-2"><i class="fa fa-arrow-circle-left"></i> Go to sign in page</a>
						<?php } else { ?>
							<p class="text-muted">Create your account</p>
							<form method="POST" action="{{ route('register') }}">
								{{ csrf_field() }}
								<div class="input-group mb-3">
									<span class="input-group-addon"><i class="icon-user"></i></span>
									<input type="text" name="name" class="form-control" required autofocus placeholder="Username">
								</div>

								<div class="input-group mb-3">
									<span class="input-group-addon">@</span>
									<input type="text" name="email" class="form-control" required placeholder="Email">
								</div>

								<div class="input-group mb-3">
									<span class="input-group-addon"><i class="icon-lock"></i></span>
									<input type="password" name="password" class="form-control" required placeholder="Password">
								</div>

								<div class="input-group mb-3">
									<span class="input-group-addon"><i class="icon-lock"></i></span>
									<input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm Password">
								</div>
								
								<?php if (!empty($error_code)) { ?>
									<div class="alert alert-danger">
										<?= __('message.'.$error_code) ?>
									</div>
								<?php } ?>

								<button type="submit" class="btn btn-block btn-warning">Create Account</button>
							</form>

							<a href="{{ route('login') }}" class="btn btn-block btn-secondary mt-2">You have already an account? Sign in</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap and necessary plugins -->
	<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
	<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
	<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>

</body>
</html>