<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
				$payload = [
					[
						'name' => 'Tes Fisik',
					],
					[
						'name' => 'Tes Wawancara',
					],
					[
						'name' => 'Tes Buta Warna',
					],
				];

				foreach ($payload as $value) {
					QuestionType::create($value);
				}
    }
}
