<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<?php
	$input['error'] = $errors->get($input['name']);
?>

<div class="form-group">
	<label for="{{ $input['id'] }}">{{ $input['label'] }}</label>

	@if (in_array($input['type'], ['radio', 'checkbox']))
		<div class="form-check">
			<input class="form-check-input"
				type="{{ $input['type'] }}"
				name="{{ $input['name'] }}"
			/>
			<label class="form-check-label">Radio</label>
		</div>
	@else
		<div class="input-group">

			<input type="{{ $input['type'] }}"
				class="form-control {{ $input['error'] ? 'is-invalid' : '' }}"
				id="{{ $input['id'] }}"
				value="{{ $input['value'] }}"
				placeholder="{{ $input['placeholder'] }}"
			/>
			{{-- <div class="custom-file">
				<input type="file" class="custom-file-input" id="exampleInputFile">
				<label class="custom-file-label" for="exampleInputFile">Choose file</label>
			</div>
			<div class="input-group-append">
				<span class="input-group-text">Upload</span>
			</div> --}}
		</div>
	@endif
</div>


{{-- <div class="form-group">
	<label class="col-form-label" for="inputError">
		<i class="far fa-times-circle"></i> Input with error
	</label>
	<input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
</div> --}}

{{-- <div class="form-group">
	<label for="exampleInputEmail1">Email address</label>
	<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
</div> --}}

{{-- <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea> --}}

{{-- <div class="form-check">
	<input class="form-check-input" type="radio" name="radio1">
	<label class="form-check-label">Radio</label>
</div> --}}

{{-- <div class="form-check">
	<input class="form-check-input" type="checkbox" checked="">
	<label class="form-check-label">Checkbox checked</label>
</div> --}}

{{-- <div class="form-group">
	<label>Select</label>
	<select class="form-control">
		<option>option 1</option>
		<option>option 2</option>
		<option>option 3</option>
		<option>option 4</option>
		<option>option 5</option>
	</select>
</div> --}}

{{-- <div class="input-group">
	<div class="input-group-prepend">
		<span class="input-group-text">
			<i class="fas fa-dollar-sign"></i>
		</span>
	</div>
	<input type="text" class="form-control">
	<div class="input-group-append">
		<div class="input-group-text"><i class="fas fa-ambulance"></i></div>
	</div>
</div> --}}

{{-- <div class="form-group">
	<label for="exampleInputFile">File input</label>
	<div class="input-group">
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="exampleInputFile">
			<label class="custom-file-label" for="exampleInputFile">Choose file</label>
		</div>
		<div class="input-group-append">
			<span class="input-group-text">Upload</span>
		</div>
	</div>
</div> --}}
