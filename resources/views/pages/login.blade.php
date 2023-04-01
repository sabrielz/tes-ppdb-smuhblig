@extends('layouts.auth')

@section('card-body')
	{{-- <p class="login-box-msg">TES PPDB</p> --}}

	<form action="" method="post">
		@csrf

		<div class="input-group mb-3">
			<input type="text" name="username" class="form-control" placeholder="Username">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-user"></span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<input type="password" name="password" class="form-control" placeholder="Password">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<a href="{{ route('dashboard.index') }}" class="btn btn-primary btn-block">
					Sign In <i class="fa fa-sign-in-alt"></i>
				</a>
				{{-- <button type="submit" class="btn btn-primary btn-block">
					Sign In <i class="fa fa-sign-in-alt"></i>
				</button> --}}
			</div>
			<!-- /.col -->
		</div>
	</form>

	{{-- <div class="social-auth-links text-center mt-2 mb-3">
		<a href="#" class="btn btn-block btn-primary">
			<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
		</a>
		<a href="#" class="btn btn-block btn-danger">
			<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
		</a>
	</div> --}}
	<!-- /.social-auth-links -->

	{{-- <p class="mb-1">
		<a href="forgot-password.html">I forgot my password</a>
	</p>
	<p class="mb-0">
		<a href="register.html" class="text-center">Register a new membership</a>
	</p> --}}
@endsection
