<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        try {
            $configs = Config::getConfigs();
            View::share('appconfigs', $configs);
        } catch (\Throwable $th) {
            echo "Operation failed when getting appconfigs from db.";
        }
    }
}
