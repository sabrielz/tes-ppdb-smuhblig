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

if (!function_exists('set_alert')) {
    function alert(null|array $value = null) :mixed {
        $result = null;

        if (is_null($value)) {
            $result = request('alert');
        } elseif (is_array($value)) {
            $result = request(['alert' => $value]);
        }

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
