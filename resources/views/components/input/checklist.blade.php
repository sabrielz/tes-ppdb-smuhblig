<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->

<input
	type="{{ $input['type'] }}"
	name="{{ $input['name'] }}"
	id="{{ $input['id'] }}"
	placeholder="{{ $input['placeholder'] }}"
	value="{{ $input['value'] }}"
	aria-label="{{ $input['label'] }}"
	class="{{ $input['class'] }}"
	@checked( $input['selected'] )
/>
