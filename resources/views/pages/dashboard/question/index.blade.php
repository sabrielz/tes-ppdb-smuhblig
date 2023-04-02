@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body">
				<table class="table w-100">
					<thead>
						<th>No.</th>
						<th>Pertanyaan</th>
						<th>Jawaban</th>
						<th>Tindakan</th>
					</thead>
					<tbody>
						@foreach ($questions as $quest)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $quest->question }}</td>
								<td>{{ 'No field yet' }}</td>
								<td>
									<div class="btn-group btn-group-sm">
										<a href="javascript:void()" class="btn btn-default">
											<i class="fa fa-pen"></i>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot></tfoot>
				</table>
			</div>
		</div>

	</div>
@endsection
