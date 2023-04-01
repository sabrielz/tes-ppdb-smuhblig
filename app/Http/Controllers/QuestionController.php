<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private function getWawancaraQuestion()
    {
        return Question::whereRelation('question', 'name', 'Tes Wawancara')->get();
    }

    public function index(Request $req)
    {
        $test = $req->get('test');
        $method_name = 'get' . ucfirst($test) . 'Question';
        $question = $this->$method_name();

        return view("pages.dashboard.question.index", [
            'question' => $question
        ]);
    }
}
