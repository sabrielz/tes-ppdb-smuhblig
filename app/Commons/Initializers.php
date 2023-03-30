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
