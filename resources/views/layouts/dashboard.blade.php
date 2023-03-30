@extends('layouts.main')

@pushOnce('html_styles')

@endPushOnce

@pushOnce('html_scripts')

@endPushOnce

@pushOnce('html_body_tag') class="hold-transition sidebar-mini" @endPushOnce
@section('html_body')
	<div class="wrapper">
		{{-- Navbar --}}
		<x-dashboard.navbar />

		{{-- Sidebar --}}
		<x-dashboard.sidebar />

		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<x-dashboard.breadcrumb />
				</div>
			</div>

			<div class="content">
				<div class="container-fluid">
					<div class="row">
						@yield('content')
					</div>
				</div>
			</div>
		</div>

		{{-- Rightbar --}}
		{{-- <x-dashboard.rightbar /> --}}

		{{-- Footer --}}
		<x-dashboard.footer />

	</div>
@endsection
