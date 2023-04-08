@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body">
				<form action="" method="get">
					<input type="hidden" name="test" value="{{ request()->query('test') }}">
					<div class="row">

						{{-- Search --}}
						<div class="input-group my-1 col-sm-6">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fa fa-search"></i>
								</div>
							</div>
							<input type="search" name="search" id="" class="text-center form-control form-control-sm" placeholder="Cari nama atau kode jurusan siswa..." value="{{ request('search') }}" />
						</div>

						{{-- Sort --}}
						<div class="input-group my-1 col-sm-3">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fa fa-sort"></i>
								</div>
							</div>
							<select name="sort" id="" class="form-control form-control-sm">
								<option value="">-- Urutkan --</option>
								@foreach (['id', 'nama_siswa', 'kode_jurusan', 'status', 'terbaru'] as $option)
									<option value="{{ $option }}" @selected($option == request('sort'))>
										{{ Str::title(str_replace('_', ' ', $option)) }}
									</option>
								@endforeach
							</select>
						</div>

						{{-- Order --}}
						<div class="input-group my-1 col-sm-3">
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="fa fa-arrows-alt-v"></i>
								</div>
							</div>
							<select name="order" id="" class="form-control form-control-sm">
								<option value="">-- Jenis Urutan --</option>
								@foreach (['normal', 'reverse'] as $option)
									<option value="{{ $option }}" @selected($option == request('order'))>
										{{ Str::title(str_replace('_', ' ', $option)) }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="col-12 text-center mt-2">
							<button type="reset" class="btn btn-sm px-4 btn-secondary">
								Reset <i class="fa fa-undo"></i>
							</button>
							<button type="submit" class="btn btn-sm px-4 btn-primary">
								Filter <i class="fa fa-filter"></i>
							</button>
						</div>

					</div>
				</form>
			</div>
		</div>

		<div class="col-12 card card-default">
			<div class="card-body p-0">
				<table class="table data-table table-stripped">
					<thead>
						<form action="" method="get">
							<tr>
								<th>No</th>
								<th>Nama Siswa</th>
								<th>Kode Jurusan</th>
								<th>Status</th>
								<th>Tindakan</th>
							</tr>
						</form>
					</thead>
					<tbody>
						@foreach ($students as $student => $answers)
							<?php $student = recollect(json_decode($student, true)) ?>
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $student->get('identitas')->get('nama_lengkap') }}</td>
								<td>{{ format_tanggal($student->get('identitas')->get('tanggal_lahir')) }}</td>
								<td>
									@if ($student->get('status')->get('tes_'.request()->query('test')))
										<span class="badge badge-success">Sudah Tes</span>
									@else
										<span class="badge badge-danger">Belum Tes</span>
									@endif
								</td>
								<td>
									<div class="btn-group btn-group-sm">

										{{-- Detail --}}
										<button type="button" class="btn btn-info btn-action" id="detail-siswa-{{ $loop->iteration }}" title="Detail Siswa"
											data-toggle="modal" data-target="#modal-detail-siswa" data-id="{{ $student->get('identitas')->get('id') }}" onclick="fetchData({{ $student->get('identitas')->get('id') }})">
											<i class="fa fa-info"></i>
										</button>

										<?php $payloads = [
											'student' => $answers[0]->student->username,
											'test' => request()->query('test')
										] ?>

										@if (request()->query('test') == 'wawancara')
											{{-- Tes Wawancara --}}
											<a href="{{ route('dashboard.statistic.detail', $payloads) }}"
												title="Hasil Tes Wawancara"
												class="btn btn-action btn-secondary">
												<i class="fa">W</i>
											</a>
										@elseif(request()->query('test') == 'fisik')
											{{-- Tes Fisik --}}
											<a href="{{ route('dashboard.statistic.detail', $payloads) }}"
												title="Hasil Tes Fisik"
												class="btn btn-action btn-secondary">
												<i class="fa">F</i>
											</a>
										@endif



									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-12 text-right mb-4 table-button-wrapper"></div>

		@if ($students->hasPages())
			<div class="col-12 text-center mb-4">
				{!! $students->links('vendor.pagination.bootstrap-4') !!}
			</div>
		@endif

	</div>
@endsection

@push('html_modals')
	<x-modal.detail-siswa />
@endpush

@push('html_scripts')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('html_scripts')
		<!-- DataTables  & Plugins -->
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
	<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
	<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
	<script>
		const fetchData = (id) => {
			$.ajax({
				type: "get",
				url: "{{ route('api.detail.index') }}",
				data: {
					id: id
				},
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
	<script> $(function () {
		$("table.data-table").DataTable({
      "responsive": true,
      "buttons": [
				// "copy",
				// "csv",
				"excel",
				"pdf",
				// "print",
				// "colvis"
			],
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
    }).buttons().container().appendTo('.table-button-wrapper');
	}) </script>
	<script>$(function () {
		$('#thead-form th').map((elem) => {
			console.log($(elem).parent('form'))
			$(elem).click(v => {
				v.preventDefault()
			})

		})
	})</script>
@endpush
