@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-md-6">
		{{-- Select Siswa --}}
		<div class="card card-default">
			<div class="card-header py-2">
				<label> Pilih Siswa </label>
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

			</div>
		</div>

		{{-- Quick Form --}}
		@if ($siswa && $allow_test)
			<div class="card card-default">
				<div class="card-header py-2">
					<label> Quick Form </label>
				</div>
				<div class="card-body">
					<form action="{{ route('dashboard.uniform.update', $student->identitas->seragam->id ?? '') }}" method="post"> @csrf

						<div class="row">
							@foreach ($questions as $quest)
								<div class="form-group col-12">
									<label class="form-label d-block">
										{{ $loop->iteration }}. {{ Str::Title($quest->seragam) }}
									</label>
									@foreach ($quest->ukuran as $ukuran)
										<div class="d-inline-block form-check mr-2">
											<?php
												$checkVal = 'ukuran_'.$quest->seragam;
												$selected = old($checkVal) == $ukuran || $ukuran == $student->identitas->seragam->$checkVal;
											?>
											<input name="ukuran_{{ $quest->seragam }}" id="input-quest-{{ $quest->seragam }}-{{ $ukuran }}" type="radio" class="form-check-input" value="{{ $ukuran }}" @checked($selected)>
											<label for="input-quest-{{ $quest->seragam }}-{{ $ukuran }}" class="form-check-label">{{ $ukuran }}</label>
										</div>
									@endforeach

									@error('ukuran_' . $quest->seragam)
										<p class="m-0 text-danger"> {{ $message }} </p>
									@enderror
								</div>
							@endforeach

							<div class="col-12 text-center">
								{{-- @dd(isset($student) and $student->status and $student->status->get('tes_'.request()->query('test'))) --}}
								<button type="submit" class="btn btn-primary" {{ ((isset($siswa) and !empty($siswa)) and ($allow_test ?? null)) ? '' : 'disabled' }}>
									Submit
								</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		@endif
	</div>

	<div class="col-md-6">
		{{-- Detail Student --}}
		<div class="card card-default">
			<div class="card-header py-2">
				<label> Detail Siswa </label>
			</div>
			<div class="card-body p-0">

				@if (!request('student'))
					<p class="p-2 text-center">Belum ada siswa...</p>
				@elseif (empty($siswa))
					<p class="p-2 text-center">Siswa tidak ditemukan...</p>
				@else
					<table class="table">
						<tbody>
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
@endsection
