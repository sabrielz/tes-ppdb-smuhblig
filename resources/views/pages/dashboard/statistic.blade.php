@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Siswa</th>
							<th>Kode Jurusan</th>
							<th>Tindakan</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($students as $student)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $student->name }}</td>
								<td>{{ 'On Going' }}</td>
								{{-- <td>{{  }}</td> --}}
								<td></td>
						{{-- @foreach ($students as $key => $student)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $key }}</td>
							</tr> --}}
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-12 text-center mb-4">
			{!! $students->links('vendor.pagination.bootstrap-4') !!}
		</div>

	</div>
@endsection
