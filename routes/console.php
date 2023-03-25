<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('update_dist', function () {
    exec('cd e:/master/example && e: && npm run bundle');
    exec('cp e:/master/example/css/dashboard* public/assets/css -Rf');
    exec('cp e:/master/example/dist/* public/assets/js -Rf');
    $this->comment('Dashboard styles and scripts updated successfully...');
})->purpose('Bundle and copy style and script files from my own dashboard library.');
