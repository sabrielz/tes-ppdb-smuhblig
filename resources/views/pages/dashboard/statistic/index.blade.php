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
							<th>Tanggal Lahir</th>
							<th>Status</th>
							<th>Tindakan</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($students as $student => $answers)
							<?php $student = recollect(json_decode($student, true)) ?>
							{{-- @dd($student->get('identitas')) --}}
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $student->get('identitas')->get('nama_lengkap') }}</td>
								<td>{{ format_tanggal($student->get('identitas')->get('tanggal_lahir')) }}</td>
								@if (request()->query('test') == 'wawancara')
									<td>
										{{-- {{ $student->get('status')->get('tes_wawancara') }} --}}
										@if ($student->get('status')->get('tes_wawancara'))
											<span class="badge badge-success">Sudah Tes</span>
										@else
											<span class="badge badge-danger">Belum Tes</span>
										@endif
									</td>
										
								@elseif(request()->query('test') == 'fisik')
									<td>
										{{-- {{ $student->get('status')->get('tes_fisik') }} --}}
										@if ($student->get('status')->get('tes_fisik'))
											<span class="badge badge-success">Sudah Tes</span>
										@else
											<span class="badge badge-danger">Belum Tes</span>
										@endif
									</td>
										
								@endif
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
						@endforeach

						@push('html_scripts')
											{{-- <script>
												$('#detail-siswa-{{ $loop->iteration }}').on('click', function() {
													let id = $(this).data('id')
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
												})
											</script> --}}

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
										@endpush
					</tbody>
				</table>
			</div>
		</div>

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
