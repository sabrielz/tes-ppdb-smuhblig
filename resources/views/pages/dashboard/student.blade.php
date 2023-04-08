@extends('layouts.dashboard')

@section('content')
<div class="row">

	{{-- Filter Card Form Component --}}
	<div class="col-12 card bg-primary mx-auto my-2" >
		<div class="card-body">
			<form action="" method="get">
				<label class="d-block text-center">
					<span class="d-block text-lg mb-1"> <i class="fa fa-search"></i> Temukan Siswa </span>
					<input id="input-search" type="search" value="{{ old('search', request('search')) }}" class="form-control text-center" placeholder="Masukkan nama/asal sekolah/kode jurusan..." />
				</label>
			</form>
		</div>
	</div>

	<div class="col-12 card mt-4 mb-2">
		<div class="card-body p-0">
			<table id="main-table" class="table data-table table-stripped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Lengkap</th>
						<th>Asal Sekolah</th>
						<th>Tanggal Lahir</th>
						<th>Jurusan</th>
						<th>Kode Jurusan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
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
	<script>
		$(function () {
			let findStudent = null,
				students = null,
				counter = 1;

			$('#input-search').on('keyup', function () {
				if (findStudent !== null) clearTimeout(findStudent)
				findStudent = setTimeout(() => {
					let pattern = $('#input-search').val();
					students = getStudent(pattern)
				}, 1000);
			})


			let datatable = $("table.data-table").DataTable({
				responsive: true,
				paging: true,
				lengthChange: false,
				searching: false,
				ordering: true,
				info: true,
				autoWidth: false,
				responsive: true,
				columns: [
					{
						data: null,
						render: function () {
							return counter++
						}
					},
					{ data: 'nama_lengkap' },
					{ data: 'asal_sekolah' },
					{ data: 'tanggal_lahir' },
					{ data: 'jurusan.nama' },
					{ data: 'jurusan.kode' },
					{
						data: null,
						render: function () {
							return 'some'
						}
					},
				]
			})

			// pattern = search value pattern
			function getStudent (pattern) {
				$.ajax({
					type: 'GET',
					url: `{{ route('api.student.find') }}`,
					data: { search: pattern },
					beforeSend: function () {
						datatable.clear()
						counter = 1
					},
					success: function (result) {
						if (result.data.length > 1) {
							datatable.rows.add(result.data)
						}
						datatable.draw()
					},
					error: function (err) {
						console.error(err)
					},
				})
			}
		})
	</script>
@endpush
