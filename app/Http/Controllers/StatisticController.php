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

    public function index() :View
    {
        // dd($this->getWawancaraStatistic());
        return view('pages.dashboard.statistic', [
            'students' => $this->getWawancaraStatistic()
        ]);
    }
}
