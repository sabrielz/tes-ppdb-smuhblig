<?php function getDetailSiswaTable ($siswa) :array {
	$bio = \App\Models\PPDB\User::where('username', request('student'))->first();

	$details = [];

	$details['test_type'] = Str::title(request()->get('test'));
	$details['jurusan'] = $bio->identitas->jurusan->nama;
	$details['kode_pendaftaran'] = $bio->identitas->jurusan->kode;
	$details['nama_lengkap'] = $bio->identitas->nama_lengkap;
	$details['asal_sekolah'] = $bio->identitas->asal_sekolah;
	$details['no_wa'] = $bio->identitas->no_wa_siswa;

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
