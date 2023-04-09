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
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.',
				'pilgan' => [
					1 => 'Pilihan 1',
					2 => 'Pilihan 2',
					3 => 'Pilihan 3',
					4 => 'Pilihan 4',
					5 => 'Pilihan 5',
				],
				'answer' => mt_rand(1, 5),
			],
			[
				'type_id' => 2,
				'pilgan' => [
					1 => 'Pilihan 1',
					2 => 'Pilihan 2',
					3 => 'Pilihan 3',
					4 => 'Pilihan 4',
					5 => 'Pilihan 5',
				],
				'answer' => mt_rand(1, 5),
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'pilgan' => [
					1 => 'Pilihan 1',
					2 => 'Pilihan 2',
					3 => 'Pilihan 3',
					4 => 'Pilihan 4',
					5 => 'Pilihan 5',
				],
				'answer' => mt_rand(1, 5),
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'pilgan' => [
					1 => 'Pilihan 1',
					2 => 'Pilihan 2',
					3 => 'Pilihan 3',
					4 => 'Pilihan 4',
					5 => 'Pilihan 5',
				],
				'answer' => mt_rand(1, 5),
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 2,
				'question' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem dolor, atque earum quasi, ad nemo, voluptate facere nihil voluptates neque eaque. Eius laudantium atque rem expedita id iusto. Non qui sit asperiores, quis, iure, suscipit itaque soluta quod quos ipsam iusto cupiditate enim reiciendis voluptates alias vitae minus debitis. Culpa.'
			],
			[
				'type_id' => 1,
				'pilgan' => [
					1 => 'iya',
					2 => 'partial',
					3 => 'tidak',
				],
				'question' => 'Buta Warna'
			],
			[
				'type_id' => 1,
				'pilgan' => [
					1 => 'ada',
					2 => 'tidak',
				],
				'question' => 'Tindik'
			],
			[
				'type_id' => 1,
				'pilgan' => [
					1 => 'ada',
					2 => 'tidak',
				],
				'question' => 'Tato'
			],
		];

		foreach ($payload as $value) {
			Question::create($value);
		}
	}
}
