<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $test = $req->get('test');
        $method_name = 'get' . ucfirst($test) . 'Question';
        $question = $this->$method_name();

        return view("pages.dashboard.question.index", [
            'questions' => $question
        ]);
    }
}
