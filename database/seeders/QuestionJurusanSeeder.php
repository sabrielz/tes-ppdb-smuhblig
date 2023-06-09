<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionJurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 20; $i++) { 
					DB::table('jurusan_question')->insert([
						['jurusan_id' => mt_rand(1,5), 'question_id' => mt_rand(1, 10)]
					]);
				}

				for ($i=1; $i < 6; $i++) { 
					DB::table('jurusan_question')->insert([
						['jurusan_id' => $i, 'question_id' => 11],
						['jurusan_id' => $i, 'question_id' => 12],
						['jurusan_id' => $i, 'question_id' => 13],
					]);
				}
    }
}
