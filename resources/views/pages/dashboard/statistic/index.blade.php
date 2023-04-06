@extends('layouts.dashboard')

@section('content')
	<div class="row">

		<div class="col-12 card card-default">
			<div class="card-body p-0">
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Siswa</th>
							<th>Tanggal Lahir</th>
							<th>Tes Wawancara</th>
							<th>Tes Fisik</th>
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

								{{-- Test Status --}}
								<td class="text-{{ $student->get('status')->get('tes_wawancara') ? 'success' : 'danger' }}">
									{{ $student->get('status')->get('tes_wawancara') ? 'Sudah' : 'Belum' }}
								</td>
								<td class="text-{{ $student->get('status')->get('tes_fisik') ? 'success' : 'danger' }}">
									{{ $student->get('status')->get('tes_fisik') ? 'Sudah' : 'Belum' }}
								</td>

								<td>
									<div class="btn-group btn-group-sm">

										{{-- Detail --}}
										<button type="button" class="btn btn-info btn-action" title="Detail Siswa"
											data-toggle="modal" data-target="#modal-detail-siswa"
											data-id="{{ $student->get('id') }}">
											{{-- onclick="ajaxStudentDetail(this)"> --}}
											<i class="fa fa-info"></i>
										</button>

										<?php $payloads = [
											'id' => $student->get('id'),
											'test' => request()->query('test')
										] ?>

										{{-- Tes Wawancara --}}
										<a href="{{ route('dashboard.statistic.detail', $payloads) }}"
											title="Hasil Tes Wawancara"
											class="btn btn-action btn-secondary">
											<i class="fa">W</i>
										</a>

										{{-- Tes Fisik --}}
										<a href="{{ route('dashboard.statistic.detail', $payloads) }}"
											title="Hasil Tes Fisik"
											class="btn btn-action btn-secondary">
											<i class="fa">F</i>
										</a>


									</div>
								</td>
						@endforeach
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
