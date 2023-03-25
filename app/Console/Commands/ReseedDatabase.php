<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReseedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all tables and reseeding database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Running db:truncate command...');
        $this->call('db:truncate');
        $this->info('Running db:seed command...');
        $this->call('db:seed');
    }
}
