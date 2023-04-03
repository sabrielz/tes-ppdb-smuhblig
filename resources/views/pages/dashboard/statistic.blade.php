@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body table-container">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Siswa</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($students as $student)

						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
@endsection
