<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MetadataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $metadata = [];

        $pathname = request()->path();
        if (strlen($pathname) > 1 && str_split($pathname)[0] !== '/') $pathname = "/$pathname";

        $metadatacfg = \App\Models\Config::getConfig('metadata', []);
        if (array_key_exists($pathname, $metadatacfg)) {
            $metadata = $metadatacfg[$pathname];
        }

        \Illuminate\Support\Facades\View::share('metadata', $metadata);
    }
}
