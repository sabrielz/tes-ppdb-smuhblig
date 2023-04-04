<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PPDB\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatisticController extends Controller
{
    private function getWawancaraStatistic() :Collection {
        return Answer::whereRelation('question', 'type_id', 2)->with(['student', 'question'])->get()->groupBy('student.name');
    }

    private function getFisikStatistic() :Collection {
        return Answer::whereRelation('question', 'type_id', 1)->with(['student', 'question'])->get()->groupBy('student.name');
    }

    public function index(Request $req) :View
    {
        // dd($this->getWawancaraStatistic());
				$test = $req->query('test');
        $resolver = 'get' . ucfirst($test) . 'Statistic';
        $statistic = $this->$resolver();

        return view('pages.dashboard.statistic', [
            'students' => $statistic
        ]);
    }
}
