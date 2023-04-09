@extends('layouts.main')

@pushOnce('html_body_tag') class="hold-transition login-page" @endPushOnce

@section('html_body')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      {{-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> --}}
			<img src="{{ asset('assets/img/logo-smk.png') }}"
				alt="Logo {{ $appconfigs['general']['value']['company']['name'] ?? '' }}"
				width="auto" height="50"
				class="">
    </div>
    <div class="card-body">
			@yield('card-body')
		</div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
@endsection
