<!DOCTYPE html @stack('doctype_tag')>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @stack('html_tag')>
<head @stack('html_head_tag')>

	{{-- Metadata --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	{{-- Dynamic Metadata --}}
	<title>{{ $metadata['title'] ?? '' }}</title>

	{{-- Assets --}}
	@if (env('APP_ENV') === 'production')
		<link aria-label="Google Font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> <!-- Google Font: Source Sans Pro -->
	@endif
  <link aria-label="Fontawesome Icons" rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css"> <!-- Font Awesome Icons -->
  <link aria-label="Adminlte CommonCSS" rel="stylesheet" href="/assets/css/adminlte.min.css"> <!-- Theme style -->

	@stack('html_styles')
</head>
<body @stack('html_body_tag')>
	@yield('html_body')

	{{-- Scripts --}}
	<script aria-label="JQuery" src="/plugins/jquery/jquery.min.js"></script> <!-- jQuery -->
	<script aria-label="Bootstrap 4" src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap 4 -->
	<script aria-label="AdminLTE CommonJS" src="/assets/js/adminlte.min.js"></script> <!-- AdminLTE App -->

	@stack('html_scripts')
</body>
</html>
