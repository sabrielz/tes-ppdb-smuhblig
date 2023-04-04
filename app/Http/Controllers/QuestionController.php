<?php

namespace App\Http\Controllers;

use App\Models\Question;
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

    public function index(Request $req) :View
    {
        $test = $req->get('test');
        $method_name = 'get' . ucfirst($test) . 'Questions';
        $question = $this->$method_name();

        return view("pages.dashboard.question.index", [
            'questions' => $question
        ]);
    }

    public function edit (Question $question) :View
    {
        return view('pages.dashboard.question.edit', [
            'question' => $question
        ]);
    }

    public function update (Request $req, Question $question) :RedirectResponse
    {
        // update question
        return redirect()->route('dashboard.question.index', ['test' => 'wawancara']);
    }

    public function delete (Question $question) :RedirectResponse
    {
        try {
            $question->delete();
            alert(['success' => 'Berhasil menghapus data.']);
            return redirect()->route('dashboard.question.index', ['test' => 'wawancara']);
        } catch (\Throwable $th) {
            alert(['danger' => 'Maaf terjadi kesalahan saat menghapus data.']);
            return back();
        }
    }
}
