<?php

if (!function_exists('is_active_link')) {
    function is_active_link(string|array $link) {
        $href = '';

        // Init href
        if (is_string($link)) $href = $link;
        else $href = $link['active'] ?? $link['href'] ?? $link['link'] ?? '';

        // If root url
        if (str_starts_with($href, '/')) $href = substr($href, 1);

        return request()->is($href);
    }
}

if (!function_exists('alert')) {
    function alert(null|array $value = null) :mixed {
        $result = null;

        if (is_null($value)) {
            $result = session()->pull('alert', []);
        } elseif (is_array($value)) {
            $result = session(['alert' => $value]);
        }

		// session()->remove('alert');

        return $result;
    }
}

if (!function_exists('merge_url')) {
    function merge_url(?string $current = null, ...$others) :string {
        if (is_null($current)) $current = '/'.request()->path();
        $result = implode('/', [$current, ...$others]);
        return $result;
    }
}

if (!function_exists('merge_url_with_params')) {
    function merge_url_with_params(?string $current = null, ...$others) :string {
        $result = merge_url($current, ...$others);
        $queries = request()->getQueryString();
        if (strlen($queries) > 0) $result .= "?$queries";
        return $result;
    }
}

if (!function_exists('get_paginate_url')) {
	function get_paginate_url(int $page) {
		return request()->fullUrlWithQuery([
			...request()->query->all(),
			'page' => $page
		]);
	}
}

if (!function_exists('to_tanggal')) {
	function to_tanggal($tanggal = null) {
		return date('d-m-Y', $tanggal);
	}
}

if (!function_exists('format_tanggal')) {
	function format_tanggal($tanggal = null) {
		$date = new DateTime($tanggal);
		return date_format($date, 'd/m/Y');
	}
}

if (!function_exists('format_full_tanggal')) {
	function format_full_tanggal($tanggal = null) {
		$date = new DateTime($tanggal);
		return date_format($date, 'D F Y');
	}
}

if (!function_exists('recollect')) {
	function recollect(?array $array = null) {
		if (is_null($array)) return collect();

		foreach ($array as $key => $val) {
			if (is_array($val)) {
				$val = recollect($val);
				$array[$key] = $val;
			}
		}

		return collect($array);
	}
}
