<?php

namespace App\Http\Controllers;

// use
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    private function getFisikQuestions () {
        return Question::whereRelation('type', 'name', 'Tes Buta Warna')->get();
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
}
