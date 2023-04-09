<?php

namespace App\Http\Controllers;

use App\Models\PPDB\Jurusan;
use App\Models\Question;
use Illuminate\Http\Request;

class WawancaraController extends Controller
{
		public function index()
		{
			$question = Question::with('type')->filter(['type' => 2])->get();

			return;
		}

    public function store(Request $request)
		{
			$validata = $request->validate([
				'question' => 'required'
			]);

			$validata['type_id'] = 2;

			if(!$request->jurusan_id) {
				$validata['jurusan_id'] = Jurusan::get('id');
			} else {
				$validata['jurusan_id'] = $request->jurusan_id;
			};


			$question = Question::create($validata);

			$question->jurusan->attach($validata['jurusan_id']);

			return;
		}

		public function update(Request $request, Question $question)
		{
			$validata = $request->validate([
				'question' => 'required'
			]);

			$validata['type_id'] = 2;
			
			$question->update($validata);
			
			if(!$request->jurusan_id) {
				$validata['jurusan_id'] = Jurusan::get('id');
			} else {
				$validata['jurusan_id'] = $request->jurusan_id;
			};

			$question->jurusan->sync($validata['jurusan_id']);

			return;
		}
}
