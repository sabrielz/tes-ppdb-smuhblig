@extends('layouts.dashboard')

<?php
	if (!isset($question) or empty($question)) {
		$question = collect([
			'id' => null,
			'question' => null,
			'answer' => null,
		]);
	}
	$method ??= 'create';

	$action; $submethod;
	dd($question->get('slug'));
	if ($method === 'edit') { $action = route('dashboard.question.update', ['question' => $question->get('id')]); }
	elseif ($method === 'create') { $action = route('dashboard.question.create'); }

?>

@section('content')

	<form action="{{ $action }}" method="post"> @csrf
		<div class="row">

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Tipe Tes</label>
				</div>
				<div class="card-body">
					<select name="test" id="" class="form-control">
						<option value="">-- Pilih Tipe Tes --</option>

						@foreach ($question_types as $type)
							<?php $selected = old('test') === $type->slug ?>
							<option @selected($selected) value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Pertanyaan</label>
				</div>
				<div class="card-body">
					<textarea
						name="question"
						id=""
						class="form-control"
						placeholder="Masukkan pertanyaan..."
						> {{ old('question') ?? $question->get('question') ?? null }} </textarea>
				</div>
			</div>

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Jawaban</label>
				</div>
				<div class="card-body">
					<textarea
						name="answer"
						id=""
						class="form-control"
						placeholder="(Opsional) Masukkan jawaban..."
					> {{ old('answer') ?? $question->get('answer') ?? null }} </textarea>
				</div>
			</div>

			<div class="col-12 text-center">
				<button type="submit" class="mx-auto btn btn-warning">
					Edit <i class="fa fa-edit"></i>
				</button>
			</div>

		</div>
	</form>

@endsection
