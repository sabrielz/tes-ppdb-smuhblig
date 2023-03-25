<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
			$payload = [
				[
					'nama' => 'Teknik Kendaraan Ringan',
					'singkatan' => 'tkr'
				],
				[
					'nama' => 'Teknik Sepeda Motor',
					'singkatan' => 'tsm'
				],
				[
					'nama' => 'Teknik Komputer dan Jaringan',
					'singkatan' => 'tkj'
				],
				[
					'nama' => 'Akuntansi',
					'singkatan' => 'akuntansi'
				],
				[
					'nama' => 'Farmasi Klinis dan Komunitas',
					'singkatan' => 'fkk'
				],
			];

			foreach ($payload as $value) {
        Jurusan::create($value);
			}
    }
}
