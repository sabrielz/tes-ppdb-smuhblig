<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
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
        if (request()->isMethod('GET')) {
            $metadata = [];

            $pathname = request()->path();
            $metadatacfg = \App\Models\Config::getConfig('metadata');
            foreach ($metadatacfg as $pathname => $data) {
                if (request()->is($pathname)) {
                    $metadata = $data; break;
                }
            }

            \Illuminate\Support\Facades\View::share('metadata', $metadata);
        }
    }
}
