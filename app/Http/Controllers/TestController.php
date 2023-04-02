<?php

namespace App\Http\Controllers;

// use

use App\Models\Answer;
use App\Models\PPDB\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    private function getFisikQuestions () {
        // return Question::whereRelation('type', 'name', 'Tes Buta Warna')->get();
        return Question::filter(['type' => 3, 'type' => 1])->get();
    }

    private function getWawancaraQuestions() {
        return Question::whereRelation('type', 'name', 'Tes Wawancara')->get();
    }

    public function index(Request $req)
    {
        $test = $req->query('test');
        $resolver = 'get'.ucfirst($test).'Questions';
        $questions = $this->$resolver();

        return view("pages.dashboard.test.$test", [
            'questions' => $questions
        ]);
    }

		public function store(Request $req)
		{
			$valiData = $req->validate([
				'data.answer' => 'required',
				'data.question_id' => 'required'
			]);
			// dd($valiData);

			$student = User::where('username', $req->siswa)->first();

			foreach ($req->data as $data) {
				Answer::create([
					'question_id' => $data['question_id'],
					'answer' => $data['answer'],
					'student_id' => $student->id
				]);
			}
		}
}
