@extends('layouts.dashboard')

@section('content')
<div class="row">

	<div class="col-12 mb-2">
		<a href="{{ route('dashboard.question.create') }}" class="btn btn-primary btn-sm">
			<i class="fa fa-plus"></i> Tambah Soal
		</a>
	</div>

	<div class="col-12 card card-default">
		<div class="card-body p-1">
			<table class="table data-table table-hovered table-striped w-100">
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

@push('html_styles')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<style> .table.data-table tr td:nth-child(1) { vertical-align: middle !important } </style>
@endpush

@push('html_scripts')
		<!-- DataTables  & Plugins -->
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<script> $(function () {
		$("table.data-table").DataTable({
      "responsive": true,
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
    })
	}) </script>
@endpush
