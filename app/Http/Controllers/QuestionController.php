<?php

namespace App\Http\Controllers;

use App\Models\PPDB\Jurusan;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class QuestionController extends Controller
{
    private function getFisikQuestions () :Collection {
        return Question::whereRelation('type', 'name', 'Tes Fisik')->get();
    }

    private function getWawancaraQuestions() :Collection {
        return Question::whereRelation('type', 'name', 'Tes Wawancara')->get();
    }

	private function getQuestionFormPreload ()
	{
		$question_types = QuestionType::all();

		return [
			'question_types' => $question_types
		];
	}

    public function index(Request $req) :View
    {
        $test = $req->get('test');
        $method_name = 'get' . ucfirst($test) . 'Questions';
        $question = $this->$method_name();
				// dd($question);

        return view("pages.dashboard.question.index", [
            'questions' => $question,
        ]);
    }

	public function create (Request $req) :View
	{
		return view('pages.dashboard.question.form', [
			...$this->getQuestionFormPreload(),
			'jurusan' => Jurusan::all(),
		]);
	}

	public function store(Request $req)
	{
		// dd($req->all());

		$validData = $req->validate([
			'test' => 'required',
			'jurusan' => 'required',
			'question' => 'required'
		]);

		$payload = [
			'type_id' => $validData['test'],
			'question' => $validData['question']
		];

		if($req->pilgan) {
			$payload['pilgan'] = $req->pilgan;
		}

		if($req->answer) {
			$payload['answer'] = $req->answer;
		}

		$quest = Question::create($payload);

		$quest->jurusan()->attach($validData['jurusan']);

		alert(['success' => 'Berhasil menambah data.']);
		return redirect()->route('dashboard.question.index', ['test' => substr($quest->type->slug, 4)]);
	}

    public function edit (Question $question) :View
    {
			// dd($question->jurusan);
        return view('pages.dashboard.question.form', [
            'question' => $question,
			'method' => 'edit',
			'jurusan' => Jurusan::all(),
			...$this->getQuestionFormPreload()
        ]);
    }

    public function update (Request $req, Question $question) :RedirectResponse
    {
			// dd($req->all());
        // update question
				$validData = $req->validate([
					'test' => 'required',
					'jurusan' => 'required',
					'question' => 'required'
				]);
		
				$payload = [
					'type_id' => $validData['test'],
					'question' => $validData['question']
				];
		
				if($req->pilgan) {
					$payload['pilgan'] = $req->pilgan;
				} else {
					$payload['pilgan'] = null;
				}
		
				if($req->answer) {
					$payload['answer'] = $req->answer;
				} else {
					$payload['answer'] = null;
				}
		
				$question->update($payload);
		
				$question->jurusan()->sync($validData['jurusan']);
		
				alert(['success' => 'Berhasil mengubah data.']);
        return redirect()->route('dashboard.question.index', ['test' => substr($question->type->slug, 4)]);
    }

    public function delete (Question $question) :RedirectResponse
    {
        try {
						// $question->jurusan()->detach();
            $question->delete();
            alert(['success' => 'Berhasil menghapus data.']);
            return redirect()->route('dashboard.question.index', ['test' => 'wawancara']);
        } catch (\Throwable $th) {
            alert(['danger' => 'Maaf terjadi kesalahan saat menghapus data.']);
            return back();
        }
    }
}
