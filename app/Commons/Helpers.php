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
