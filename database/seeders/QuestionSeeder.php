<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payload = [
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
					[
						'type_id' => mt_rand(1,3),
						'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
					],
				];

				foreach ($payload as $value) {
					Question::create($value);
				}
    }
}
