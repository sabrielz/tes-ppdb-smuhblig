@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card card-default">
			<div class="card-header">
				<div class="card-title">
					Pilih Siswa
				</div>
			</div>
			<div class="card-body">
				<div class="col-12">
					<form action="" method="get">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fa fa-search"></i>
								</div>
							</div>
							<input type="hidden" name="test" value="{{ request()->query('test') }}">
							<input type="text" name="student" class="form-control" placeholder="Kode Jurusan: X-000" value="{{ request('student') ?? '' }}">
							<div class="input-group-append">
								<button type="submit" class="btn rounded-right btn-primary btn-flat">Pilih Siswa</button>
							</div>
						</div>

						<div class="input-group">
							<input type="text" class="form-control" value="Tes {{ Str::title(request()->query('test')) }}" disabled>
						</div>
					</form>
				</div>

				<div class="col-12 mt-3">
					<?php $query_param = request()->query->count() ? '?' . request()->getQueryString() : '' ?>
					<a href="{{ route('dashboard.test.index') . $query_param }}" class="d-block btn btn-success mx-auto">
						Mulai Tes {{ Str::title( request()->query('test') ) }}
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card card-default">
			<div class="card-header">
				<div class="card-title">
					Detail Siswa
				</div>
			</div>
			<div class="card-body p-0">

				@if (!request('student'))
					<p class="p-2 text-center">Belum ada siswa...</p>
				@elseif (empty($siswa))
					<p class="p-2 text-center">Siswa tidak ditemukan...</p>
				@else
					<table class="table">
						<tbody>
							{{-- <tr>
								<td>1.</td>
								<td>Update software</td>
								<td>
									<div class="progress progress-xs">
										<div class="progress-bar progress-bar-danger" style="width: 55%"></div>
									</div>
								</td>
								<td><span class="badge bg-danger">55%</span></td>
							</tr>
							<tr>
								<td>2.</td>
								<td>Clean database</td>
								<td>
									<div class="progress progress-xs">
										<div class="progress-bar bg-warning" style="width: 70%"></div>
									</div>
								</td>
								<td><span class="badge bg-warning">70%</span></td>
							</tr>
							<tr>
								<td>3.</td>
								<td>Cron job running</td>
								<td>
									<div class="progress progress-xs progress-striped active">
										<div class="progress-bar bg-primary" style="width: 30%"></div>
									</div>
								</td>
								<td><span class="badge bg-primary">30%</span></td>
							</tr>
							<tr>
								<td>4.</td>
								<td>Fix and squish bugs</td>
								<td>
									<div class="progress progress-xs progress-striped active">
										<div class="progress-bar bg-success" style="width: 90%"></div>
									</div>
								</td>
								<td><span class="badge bg-success">90%</span></td>
							</tr> --}}
							@foreach ($siswa as $name => $detail)
								<tr>
									<th>{{ Str::replace('_',' ', Str::title($name)) }}</th>
									<td>:</td>
									<td> {{ $detail }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif

			</div>
		</div>
	</div>
</div>

{{-- @if(isset($siswa) && !empty($siswa))
@endif --}}
@endsection
