<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->

<textarea
	name="{{ $input['name'] }}"
	id="{{ $input['id'] }}"
	cols="{{ $input['attrs']['cols'] ?? null }}"
	rows="{{ $input['attrs']['rows'] ?? null }}"
	class="{{ $input['class'] }}"
>
	{!! $input['value'] !!}
</textarea>
