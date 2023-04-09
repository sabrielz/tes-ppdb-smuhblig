@extends('layouts.main')

@pushOnce('html_body_tag') class="hold-transition" @endPushOnce
@section('html_body')
	<div class="w-screen h-screen mx-auto max-w-screen-sm flex flex-wrap justify-center items-center">
		<a href="" class="w-100 basis-[250px] btn btn-success">
			<i class="fas fa-6x d-block m-2 fa-user"></i>
			<span class="font-bold text-lg">Save</span>
		</a>
		<a href="" class="w-100 basis-[250px] btn btn-primary">
			<i class="fas fa-6x d-block m-2 fa-user"></i>
			<span class="font-bold text-lg">Siswa</span>
		</a>
	</div>
@endsection

@pushOnce('html_styles')
	<style>
		body {
			flex-direction: row;
			flex-wrap: wrap;
		}
	</style>
@endPushOnce
