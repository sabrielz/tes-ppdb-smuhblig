@extends('layouts.dashboard')

@section('content')
	<form action="" method="post">
		<div class="row">

			@include('pages.dashboard.test.detailsiswa')

			{{-- Butawarna Card --}}
			<div class="col-12 card card-default">
				<div class="card-header ">
					<label for="" class="m-0">1. Butawarna</label>
				</div>
				<div class="card-body">
					<div class="bs-stepper">

						<div class="bs-stepper-header" role="tablist">
							@foreach ($questions as $quest)
								<?php $active = $loop->first ? 'active' : '' ?>

								<div class="step {{ $active }}" data-target="#quest-part-{{ $quest->id }}">
									<button type="button" class="step-trigger" role="tab" id="quest-part-{{ $quest->id }}-trigger">
										<span class="bs-stepper-circle">{{ $loop->iteration }}</span>
									</button>
								</div>

								@if (!$loop->last) <div class="line"></div> @endif
							@endforeach
						</div>

						<div class="bs-stepper-content">
							<!-- your steps content here -->
							@foreach ($questions as $quest)
								<?php $active = $loop->first ? 'active' : '' ?>

								<div id="quest-part-{{ $quest->id }}" class="content {{ $active }} bstepper-block" role="tabpanel" aria-labelledby="quest-part-{{ $quest->id }}-trigger">
									<img src="{{ asset('assets/img/photo2.png') }}"
										alt="Butawarna Gambar Id {{ $quest->id }}"
										class="w-100 d-block mx-auto h-auto wx-md-75"
										style="max-width: 480px"
									/>

									<br />

									<div class="form-group row">
										<label for="inputButawarna{{ $quest->id }}" class="col-md-4">
											Jawaban
										</label>

										<div class="input-group col-md-8">
											<input type="text" class="form-control" id="inputButawarna{{ $quest->id }}">
										</div>
									</div>

									<div class="d-flex text-center mx-auto" style="max-width: max-content">
										@if (!$loop->first)
											<button type="button" class="btn btn-sm mr-1 btn-primary" onclick="stepper.previous()">Kembali</button>
										@endif

										@if (!$loop->last)
											<button type="button" class="btn btn-sm mr-1 btn-primary" onclick="stepper.next()">Selanjutnya</button>
										@endif
									</div>
								</div>
							@endforeach
						</div>

					</div>
				</div>
			</div>

			{{-- Tindik Card --}}
			<div class="col-12 card card-default">
				<div class="card-body">

					{{-- Tindik Field Input --}}
					<div class="row m-0">
						<label for="" class="col-sm-3">2. Tindik</label>
						<div class="form-group col-sm-9 m-0">
							<div class="d-inline-block form-check mr-2">
								<input name="tindik" id="tindikInputRadioAda" type="radio" class="form-check-input" value="ada">
								<label for="tindikInputRadioAda" class="form-check-label">Ada</label>
							</div>
							<div class="d-inline-block form-check">
								<input name="tindik" id="tindikInputRadioTidak" type="radio" class="form-check-input" value="tidak">
								<label for="tindikInputRadioTidak" class="form-check-label">Tidak</label>
							</div>
						</div>
					</div>

				</div>
			</div>

			{{-- Tato Card --}}
			<div class="col-12 card card-default">
				<div class="card-body">

					{{-- Tato Field Input --}}
					<div class="row m-0">
						<label for="" class="col-sm-3">3. Tato</label>
						<div class="form-group col-sm-9 m-0">
							<div class="d-inline-block form-check mr-2">
								<input name="tato" id="tatoInputRadioAda" type="radio" class="form-check-input" value="ada">
								<label for="tatoInputRadioAda" class="form-check-label">Ada</label>
							</div>
							<div class="d-inline-block form-check">
								<input name="tato" id="tatoInputRadioTidak" type="radio" class="form-check-input" value="tidak">
								<label for="tatoInputRadioTidak" class="form-check-label">Tidak</label>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-12 text-center mb-4">
				<button type="submit" class="btn btn-primary">
					Submit <i class="fa fa-angle-right"></i>
				</button>
			</div>

		</div>
	</form>
@endsection

@pushOnce('html_styles')
	<link rel="stylesheet" href="/plugins/bs-stepper/css/bs-stepper.min.css">
@endPushOnce
@pushOnce('html_scripts')
	<script src="/plugins/bs-stepper/js/bs-stepper.min.js"></script>
	<script>
		$(function () {
			window.stepper = new Stepper( $('.bs-stepper').get(0) )
		})
	</script>
@endPushOnce
