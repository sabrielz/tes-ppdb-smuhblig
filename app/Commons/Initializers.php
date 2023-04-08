<?php

if (!function_exists('initAnchor')) {
    function initLink (array $link = []) {
        $href = $link['href'] ?? $link['link'] ?? '';
        $active = explode('', $href)[0] === '/' ? substr($href, 1) : $href;

        return array_replace_recursive([
            'href' => $link['href'] ?? $link['link'] ?? '',
            'link' => $link['link'] ?? $link['href'] ?? '',
            'label' => $link['label'] ?? '',
            'title' => $link['title'] ?? $link['label'] ?? '',
            'active' => $link['active'] ?? $active
        ], $link);
    }
}

if (!function_exists('init_breadcrumb')) {
    function init_breadcrumb (array|string|null $segments = null) {
        $breadcrumbs = [];

        // Init segments array
        if (is_null($segments)) $segments = request()->segments();
        elseif (is_string($segments)) $segments = explode('/', $segments);

        // Loop each segments
        // for ($i = 0; $i < count($segments); $i++) {
        //     if ($i === 0 && $i === count($segments)) { // Only one segment
        //         $breadcrumbs[] = [

        //         ]
        //     }
        // }
    }
}

if (! function_exists('init_input')) {
	function init_input(array $input): array {
		$icon = $input['icon'] ??= null;
		$type = $input['type'] ??= 'text';
		$variant = $input['variant'] ??= 'default';
		$name = $input['name'] ??= null;
		$value = $input['value'] ??= request($input['name']) ?? old($input['name']);
		$desc = $input['desc'] ??= null;
		$label = $input['label'] ??= null;
		$id = $input['id'] ??= $name;
		$placeholder = $input['placeholder'] ??= null;
		$selected = $input['selected'] ??= false;
		$attrs = $input['attrs'] ??= [];
		$opts = $input['opts'] ??= [];

		return array_replace_recursive($input, [
			'icon' => $icon,
			'type' => $type,
			'variant' => $variant,
			'name' => $name,
			'desc' => $desc,
			'value' => $value,
			'label' => $label,
			'id' => $id,
			'placeholder' => $placeholder,
			'selected' => $selected,
			'attrs' => $attrs,
			'opts' => $opts,
		]);
	}
}
