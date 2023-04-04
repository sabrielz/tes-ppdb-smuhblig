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
        // return Answer::whereRelation('question', 'type_id', 2)->with(['student', 'question'])->get()->groupBy('student');
		return User::whereRelation('level', 'name', 'siswa')->with(['answers'])->paginate(15);
    }

    private function getFisikStatistic() :Collection {
        return Answer::whereRelation('question', 'type_id', 1)->with(['student', 'question'])->get()->groupBy('student.name');
    }

    public function index(Request $req) :View
    {
		try {
			$test = $req->query('test');
			$method_name = 'get' . ucfirst($test) . 'Statistic';
			$statistics = $this->$method_name();
			// dd($statistics);

			return view('pages.dashboard.statistic', [
				'students' => $statistics
			]);
		} catch (\Throwable $th) {
			throw $th;
		}
    }
}
