<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	{{-- Metadata --}}
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Document</title>

	{{-- Assets --}}
	<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">
</head>
<body>

	{{-- Dashboard Wrapper --}}
	<div id="wrapper">

		<!-- Sidebar -->
		<x-dashboard.sidebar />

		<!-- Content -->
		<main id="main">
			<div id="mainContainer">
				<!-- Navbar -->
				<x-dashboard.navbar />

				<!-- Main -->
				<div id="content" class="bg-slate-700">
					<div id="contentContainer" class="">
						@yield('main')
					</div>
				</div>

				<!-- Footer -->
				<x-dashboard.footer />
			</div>
		</main>
	</div>

	{{-- Scripts --}}
	<script src="{{ asset('assets/js/dashboard.js') }}"></script>
</html>
