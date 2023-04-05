@extends('layouts.dashboard')

@section('content')
	<form action="" method="post">
		@csrf
		<div class="row">

			@include('pages.dashboard.test.detailsiswa')

			@foreach ($questions as $quest)
				<div class="col-12 card card-default">
					<div class="card-header">
						<label for="" class="">
							{{ $loop->iteration }}. {{ $quest->question }}
						</label>
					</div>

					<div class="card-body">
						{{--  --}}
						@if ($quest->pilgan == null)
							<textarea type="text"
								name="answer[{{ $quest->id }}]"
								id="input-quest-{{ $quest->id }}"
								placeholder="Jawaban..."
								class="form-control"
							></textarea>

							@error('answer.' . $quest->id)
								<p class="m-0 text-danger">
									{{ $message }}
								</p>
							@enderror

						{{--  --}}
						@else
							<input type="hidden" name="answer[{{ $quest->id }}]" value="">
							@foreach ($quest->pilgan as $key => $pilgan)
								<div class="d-flex form-check mr-2">
									<input name="answer[{{ $quest->id }}]" id="input-quest-{{ $quest->id }}-{{ $key }}" type="radio" class="form-check-input" value="{{ $key }}">
									<label for="input-quest-{{ $quest->id }}-{{ $key }}" class="form-check-label">{{ Str::Title($pilgan) }}</label>
								</div>
							@endforeach
							@error('answer.' . $quest->id)
								<p class="m-0 text-danger">
									{{ $message }}
								</p>
							@enderror
						@endif
					</div>
				</div>
			@endforeach

			<div class="col-12 text-center mb-4">
				<button type="submit" class="btn btn-primary">
					Submit <i class="fa fa-angle-right"></i>
				</button>
			</div>

		</div>
	</form>
@endsection
