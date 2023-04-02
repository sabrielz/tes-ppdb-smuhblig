@extends('layouts.dashboard')

@section('content')

	<form action="{{ route('dashboard.question.update', ['question' => $question->id]) }}" method="post"> @csrf
		<div class="row">

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Tipe Tes</label>
				</div>
				<div class="card-body">
					<select name="test" id="" class="form-control">
						<option value="">-- Pilih Tipe Tes --</option>
						@foreach (['wawancara', 'butawarna'] as $type)
							<?php $selected = old('test') === $type ?>
							<option @selected(true) value="{{ $type }}">{{ Str::title($type) }}</option>
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
						> {{ old('question') ?? $question->question ?? null }} </textarea>
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
					> {{ old('answer') ?? $question->answer ?? null }} </textarea>
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
