@extends('layouts.dashboard')

@section('content')
	<form action="" method="post">
		@csrf
		<div class="row">

			@include('pages.dashboard.test.detailsiswa')

			@if (count($questions) > 0)
				@foreach ($questions as $quest)
					<div class="col-12 card card-default">
						<div class="card-header">
							<label for="" class="">
								{{ $loop->iteration }}. {{ $quest->question->question }}
							</label>
						</div>

						<div class="card-body">
							{{--  --}}
							@if ($quest->question->pilgan == null)
								<textarea type="text"
									name="answer[{{ $quest->id }}]"
									id="input-quest-{{ $quest->id }}"
									placeholder="Jawaban..."
									class="form-control"
									disabled
								>{{ $quest->answer }}</textarea>
							{{--  --}}
							@else
								<input type="hidden" name="answer[{{ $quest->id }}]" value="">
								@foreach ($quest->question->pilgan as $key => $pilgan)
									<?php $selected = $quest->answer == $key ?>
									<div class="d-flex form-check mr-2">
										<input disabled @checked($selected) name="answer[{{ $quest->id }}]" id="input-quest-{{ $quest->id }}-{{ $key }}" type="radio" class="form-check-input" value="{{ $key }}">
										<label for="input-quest-{{ $quest->id }}-{{ $key }}" class="form-check-label">{{ Str::Title($pilgan) }}</label>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				@endforeach
			@else
				<b class="m-auto text-danger">Peseta Belum Melakukan Tes {{ ucfirst(request()->query('test')) }}</b>
			@endif

			<div class="col-12 text-center mb-4">
				<?php $payload = [
					'student' => $questions[0]->student->username,
					'test' => request()->query('test')
				] ?>
				<a href="{{ route('dashboard.statistic.edit', $payload) }}" class="btn btn-warning">
					Edit <i class="fa fa-edit"></i>
				</a>
			</div>

		</div>
	</form>
@endsection
