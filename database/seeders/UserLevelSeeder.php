<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_levels')->insert(
					[
						['label' => 'Admin Tes Fisik', 'name' => 'admin-fisik', 'desc' => 'Panitia Tes Fisik' ],
						['label' => 'Admin Tes Wawancara', 'name' => 'admin-wawancara', 'desc' => 'Panitia Tes Wawancara' ],
						['label' => 'Admin Tes Buta Warna', 'name' => 'admin-buta-warna', 'desc' => 'Panitia Tes Buta Warna' ],
						['label' => 'Super Admin', 'name' => 'super-admin', 'desc' => 'Top Level Privilege' ],
					]
					);
    }
}
