<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate all tables in database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->comment('Getting table names from db '.env('DB_DATABASE').'...');
        $table_names = DB::query()
            ->select('TABLE_NAME')
            ->fromRaw('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->get();

        $this->comment('Truncating each tables...');
        foreach ($table_names as $table) {
            $table = $table->TABLE_NAME;
            DB::table($table)->truncate();
            $this->info("Table $table successfully truncated.");
        }

        $this->info('All tables successfully truncated');
    }
}
