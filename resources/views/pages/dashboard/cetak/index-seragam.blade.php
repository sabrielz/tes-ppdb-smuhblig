<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $page['title'] ?? $title ?? '' }}</title>
  <link aria-label="Adminlte CommonCSS" rel="stylesheet" type="text/css" href="/assets/css/adminlte.min.css"> <!-- Theme style -->
	<style>
		:root, html, body {font-size: 12px}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="w-100 d-flex justify-content-center mb-3">
			<img src="/pdf/img/kop.png" alt="kop surat" width="90%">
		</div>

		<h1 class="text-center text-bold"> {{ $title ?? $page['title'] ?? '' }} </h1>
		<br>

		@if (!$students->isEmpty())
			<table class="table text-center table-responsive table-bordered">
				<thead>
					<th>No</th>
					<th>Nama</th>
					<th>Kode Jurusan</th>
					<th>Ukuran Wearpack</th>
					<th>Ukuran Olahraga</th>
					<th>Ukuran Almamater</th>
				</thead>
				<tbody>
					@foreach ($students as $student => $answers)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $student ?? ''}}</td>
						<td>{{ $answers->first()->identitas->jurusan->kode }}</td>
						<td>{{ $answers->first()->identitas->seragam->ukuran_wearpack }}</td>
						<td>{{ $answers->first()->identitas->seragam->ukuran_olahraga }}</td>
						<td>{{ $answers->first()->identitas->seragam->ukuran_almamater }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
	<script defer>
		window.onload = () => window.print()
		document.querySelectorAll('table').forEach(elem => {
			let tbody = elem.children[0];
			if (tbody.clientWidth < elem.clientWidth) {
			elem.style.display = 'table';
		} else elem.style.display = 'block';
		})
	</script>
</body>
</html>