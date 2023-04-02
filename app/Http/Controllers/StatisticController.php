<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatisticController extends Controller
{
    private function getWawancaraStatistic() :Collection {
        return Answer::with(['question', 'student'])
            ->whereRelation('question', '')->latest()->get();
    }

    public function index() :View
    {
        return view('pages.dashboard.statistic', [

        ]);
    }
}
