<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'Super Admin',
        //     'username' => 'super-admin',
        //     'password' => Hash::make('superadmin'),
				// 		'level_id' => 5
        // ]);

        $this->call([
            ConfigSeeder::class,
            QuestionSeeder::class,
            QuestionTypeSeeder::class,
						QuestionJurusanSeeder::class,
        ]);
    }
}
