<?php function getDetailSiswaTable ($siswa) :array {
	$details = [];

	$details['test_type'] = Str::title(request()->get('test'));
	$details['nama_lengkap'] = 'M. Zaenal Abidin';
	$details['asal_sekolah'] = 'Google Corporation';
	$details['no_wa'] = '08123456789';

	return $details;
} ?>

<div class="col-12 card card-default">
	<div class="card-header">
		<label for="" class="m-0">Detail Siswa</label>
	</div>
	<div class="card-body">
		<table class="table table-sm table-borderless w-auto">
			<tbody>
				@foreach (getDetailSiswaTable([]) as $name => $detail)
					<tr>
						<th>{{ Str::replace('_',' ', Str::title($name)) }}</th>
						<td>:</td>
						<td> {{ $detail }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
