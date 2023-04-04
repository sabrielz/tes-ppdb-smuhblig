@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body p-1">
				<table class="table table-hovered table-striped w-100">
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
								<td>{{ $quest->pilgan[$quest->answer] ?? 'Tidak Ada Jawaban Default' }}</td>
								<td>
									<div class="btn-group btn-group-sm">
										{{-- Button Edit --}}
										<a href="{{ merge_url(null, $quest->id, 'edit') }}" class="btn btn-warning">
											<i class="fa fa-pen"></i>
										</a>
										{{-- Button Hapus --}}
										<a href="{{ merge_url(null, $quest->id, 'delete') }}" class="btn btn-danger">
											<i class="fa fa-trash"></i>
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
