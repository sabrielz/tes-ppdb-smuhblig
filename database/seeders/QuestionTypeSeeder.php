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
						'slug' => 'tes-fisik'
					],
					[
						'name' => 'Tes Wawancara',
						'slug' => 'tes-wawancara'
					],
				];

				foreach ($payload as $value) {
					QuestionType::create($value);
				}
    }
}
