<?php

namespace App\Jobs;

use App\Models\PPDB\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetStudent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $username
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->onConnection('mysql1');

        try {
            static::$user = User::where('username', $this->username)->first();
        } catch (\Throwable $th) {
            $this->release();
        }
    }

    public static function getUser() :User
    {
        return static::$user;
    }
}
