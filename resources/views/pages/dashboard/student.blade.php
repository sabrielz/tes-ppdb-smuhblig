@extends('layouts.dashboard')

@section('content')
<div class="row">

	{{-- Filter Card Form Component --}}
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
						<input type="search" name="search" id="" class="form-control form-control-sm" placeholder="Cari nama atau kode jurusan siswa..." value="{{ request('search') }}" />
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

					{{-- Button Action --}}
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

</div>
@endsection
