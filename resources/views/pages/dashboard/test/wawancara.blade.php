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
						<div class="form-group m-0 row">
							<input type="hidden" name="data[{{ $loop->iteration }}][question_id]" value="{{ $quest->id }}">
							{{-- <label for="" class="col-md-4">
								Jawaban
							</label> --}}

							{{-- <div class="input-group m-0 col-md-8"> --}}
								<textarea type="text"
									name="data[{{ $loop->iteration }}][answer]"
									id="input-quest-{{ $quest->id }}"
									placeholder="Jawaban..."
									class="form-control"
								></textarea>
								@error('data.answer')
									{{ $message }}
								@enderror
							{{-- </div> --}}
						</div>
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
