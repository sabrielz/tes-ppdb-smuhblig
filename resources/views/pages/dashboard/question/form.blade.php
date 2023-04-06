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
	// dd($question->id);
	if ($method === 'edit') { $action = route('dashboard.question.update', ['question' => $question->id]); }
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
						<option>-- Pilih Tipe Tes --</option>

						@foreach ($question_types as $type)
							<?php $selected = old('test') === $type->slug || !empty($question->type) ?  $question->type->slug === $type->slug : null ?>
							<option value="{{ $type->id }}" @selected($selected) >{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Jurusan</label>
				</div>
				<div class="card-body">
					@foreach ($jurusan as $jrs)
						<div class="d-flex form-check mr-2">
							<?php 
								$name = 'jurusan[' . $loop->index . ']';
								$selected = old($name);
								if ($question->jurusan) {
									foreach ($jurusan as $jrs) {
										$result = $question->jurusan->filter( function($j) use ($jrs, &$selected) {
											$selected = true;
											return $jrs->id == $j->id;
										});
									}
								}
							?>
							<input name="jurusan[]" id="{{ $jrs->slug }}" type="checkbox" class="form-check-input" value="{{ $jrs->id }}">
							<label for="{{ $jrs->slug }}" class="form-check-label">{{ $jrs->nama }}</label>
						</div>
					@endforeach
				</div>2
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
						>{{ old('question') ?? isset($question->question) ? $question->question : null }}</textarea>
				</div>
			</div>

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Pilihan</label>
				</div>
				<div class="card-body">
					{{-- <textarea
						name="answer"
						id=""
						class="form-control"
						placeholder="(Opsional) Masukkan jawaban..."
					> {{ old('answer') ?? $question->get('answer') ?? null }} </textarea> --}}
					@if (isset($question->pilgan) || !empty($question->pilgan))
						<div id="pilihan-col">
							@foreach ($question->pilgan as $pilgan)
								{{-- <input name="pilgan[{{ $loop->iteration }}]" type="text" class="form-control mb-2" placeholder="(Opsional) Pilihan {{ $loop->iteration }}" value="{{ $pilgan }}"> --}}
								<div class="input-group input-group-sm mb-2">
									<input name="pilgan[{{ $loop->iteration }}]" type="text" class="form-control" value="{{ $pilgan }}">
									<span class="input-group-append">
										<button type="button" class="btn btn-danger btn-flat" onclick="removeCol(this)">X</button>
									</span>
								</div>
							@endforeach
						</div>
					@else
						<div id="pilihan-col">
							{{-- <input name="pilgan[1]" type="text" class="form-control mb-2" placeholder="(Opsional) Pilihan 1"> --}}
							<div class="input-group input-group-sm mb-2" hidden>
								<input name="pilgan[1]" type="text" class="form-control">
								<span class="input-group-append">
									<button type="button" class="btn btn-danger btn-flat" onclick="removeCol(this)">X</button>
								</span>
							</div>
						</div>
					@endif
					<button type="button" onclick="addCol()" class="mt-3 btn btn-warning">
						Tambah Pilihan
					</button>
				</div>
			</div>

			@push('html_scripts')
				<script>
					const container = document.getElementById('pilihan-col');
					var inputCount = {{ isset($question->pilgan) ? count($question->pilgan) : 1 }};
					const addCol = () => {
						inputCount++;
						if(inputCount > 5){
								alert('Maksimal 5 pilihan.');
								return;
						}
						let inputGroup = document.getElementById('raw-input');
						let newInputGroup = inputGroup.cloneNode(true);
						let newInput = newInputGroup.querySelector('input')
						newInputGroup.removeAttribute('hidden')
						// let input = document.createElement('input')
						newInput.placeholder = '(Opsional) Pilihan ' + inputCount;
						newInput.name = 'pilgan['+ inputCount +']'
						// input.className = 'form-control mb-2'
						
						container.append(newInputGroup);   
					}

					const removeCol = (e) => {
						let parent = e.parentElement.parentElement
						parent.remove();
						resetCounter();
					}

					const resetCounter = () => {
						let container = document.getElementById('pilihan-col');
						let inputs = container.querySelectorAll('input');
						console.log(inputs);
						inputCount = 0;
						let counter = 0;
						inputs.forEach(input => {
							input.name = 'pilgan['+ ++counter +']'
							input.placeholder = '(Opsional) Pilihan ' + counter;
						})
					}
				</script>
			@endpush

			<div class="col-12 card card-default">
				<div class="card-header">
					<label for="">Jawaban</label>
				</div>
				<div class="card-body">
					<textarea
						name="answer"
						id=""
						class="form-control"
						placeholder="(Opsional) Masukkan jawaban... / Nomor Pilihan yang benar"
					>{{ old('answer') ?? $question->answer ?? null }}</textarea>
				</div>
			</div>

			<div class="col-12 text-center">
				<button type="submit" class="mx-auto btn btn-warning">
					{{ Str::title($method) }} <i class="fa fa-edit"></i>
				</button>
			</div>

		</div>
	</form>

	<div id="raw-input" class="input-group input-group-sm mb-2" hidden>
		<input type="text" class="form-control">
		<span class="input-group-append">
			<button type="button" class="btn btn-danger btn-flat" onclick="removeCol(this)">X</button>
		</span>
	</div>
@endsection
