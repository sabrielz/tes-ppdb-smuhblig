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

<div id="js-default-action-button-group" hidden>

	<div class="btn-group btn-group-sm">
		<button type="button" class="btn btn-info btn-action" title="Detail Siswa"
			data-toggle="modal" data-target="#modal-detail-siswa">
			<i class="fa fa-info"></i>
		</button>

		<a href="{{ route('dashboard.loby.index', ['test' => 'fisik', 'student' => 0]) }}"
			title="Tes Fisik"
			class="btn btn-secondary btn-student">
			<i class="fa">F</i>
		</a>
		<a href="{{ route('dashboard.loby.index', ['test' => 'wawancara', 'student' => 0]) }}"
			title="Tes Wawancara"
			class="btn btn-secondary btn-student">
			<i class="fa">W</i>
		</a>
		<a href="{{ route('dashboard.uniform.index', ['student' => 0]) }}"
			title="Edit Seragam"
			class="btn btn-secondary btn-student">
			<i class="fa">S</i>
		</a>
	</div>

</div>
@endsection

@push('html_modals')
	<x-modal.detail-siswa />
@endpush

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

			$('#input-search').on('keyup keypress blur change', function () {
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
						render: function (student) { // student === identitas model instance
							let rawActionElement = $('#js-default-action-button-group').clone(),
								btnTestElements = $(rawActionElement).find('a.btn-student'),
								btnDetailElement = $(rawActionElement).find('button.btn-action').first()
								// btnSeragamElement = $(rawActionElement).find('a.btn-uniform').first(),
								// newSeragamHref = btnSeragamElement.attr('href').slice(0, -1) + student.id

							rawActionElement.attr('hidden', null)
							btnDetailElement.attr('onclick', 'fetchData('+student.id+')')
							// btnSeragamElement.attr('href', newSeragamHref)
							btnTestElements.map((index, element) => {
								// remove 0 value in [?student=0] query param
								let hrefValue = $(element).attr('href').slice(0, -1) + (student.jurusan.kode || '')
								$(element).attr('href', hrefValue)
							})

							return rawActionElement.html()
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
	{{-- Ajax Button Detail Student --}}
	<script>
		const fetchData = (id) => {
			$.ajax({
				type: "get",
				url: "{{ route('api.detail.index') }}",
				data: { id: id },
				success: function (response) {
					$('#detail-body').html(`
						<table class="table table-sm table-borderless w-auto">
							<tbody>
									<tr>
										<th>Nama Lengkap</th>
										<td>:</td>
										<td>${response.data.nama_lengkap}</td>
									</tr>
									<tr>
										<th>Alamat</th>
										<td>:</td>
										<td>${response.data.alamat_desa}, ${response.data.alamat_kec}, ${response.data.alamat_kota_kab}, RT ${response.data.alamat_rt}, RW ${response.data.alamat_rw}</td>
									</tr>
									<tr>
										<th>Tempat / Tanggal Lahir</th>
										<td>:</td>
										<td>${response.data.tempat_lahir} / ${response.data.tanggal_lahir}</td>
									</tr>
									<tr>
										<th>Jenis Kelamin</th>
										<td>:</td>
										<td>${response.data.jenis_kelamin.label}</td>
									</tr>
									<tr>
										<th>Asal Sekolah</th>
										<td>:</td>
										<td>${response.data.asal_sekolah}</td>
									</tr>
									<tr>
										<th>Nomor WA</th>
										<td>:</td>
										<td>${response.data.no_wa_siswa}</td>
									</tr>
									<tr>
										<th>WA Orang Tua</th>
										<td>:</td>
										<td>${response.data.no_wa_ortu ?? '-'}</td>
									</tr>
									<tr>
										<th>Nama Ayah</th>
										<td>:</td>
										<td>${response.data.nama_ayah}</td>
									</tr>
									<tr>
										<th>Nama Ibu</th>
										<td>:</td>
										<td>${response.data.nama_ibu}</td>
									</tr>
									<tr>
										<th>Tahun Lahir Ayah</th>
										<td>:</td>
										<td>${response.data.tahun_lahir_ayah ?? '-'}</td>
									</tr>
									<tr>
										<th>Tahun Lahir Ibu</th>
										<td>:</td>
										<td>${response.data.tahun_lahir_ibu ?? '-'}</td>
									</tr>
									<tr>
										<th>NIK</th>
										<td>:</td>
										<td>${response.data.nik ?? '-'}</td>
									</tr>
									<tr>
										<th>NISN</th>
										<td>:</td>
										<td>${response.data.nisn ?? '-'}</td>
									</tr>
									<tr>
										<th>No. Ijazah</th>
										<td>:</td>
										<td>${response.data.no_ijazah ?? '-'}</td>
									</tr>
									<tr>
										<th>No. Ujian Nasional</th>
										<td>:</td>
										<td>${response.data.no_ujian_nasional ?? '-'}</td>
									</tr>
							</tbody>
						</table>
					`);
				}
			});
		}
	</script>
@endpush
