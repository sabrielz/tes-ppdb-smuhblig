<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PPDB\Identitas;
use App\Models\PPDB\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StatisticController extends Controller
{
    private function getWawancaraStatistic() {
		$result = Answer::whereRelation('question', 'type_id', 2)->with(['student', 'question'])->paginate(15);
		$result->setCollection($result->groupBy('student'));
		return $result;
    }

    private function getFisikStatistic() {
        $result = Answer::whereRelation('question', 'type_id', 1)->with(['student', 'question'])->paginate(15);
		$result->setCollection($result->groupBy('student'));
		return $result;
    }

    public function index(Request $req) :View
    {
		try {
			$test = $req->query('test');
			$method_name = 'get' . ucfirst($test) . 'Statistic';
			$statistics = $this->$method_name();
			// dd($statistics);

			return view('pages.dashboard.statistic.index', [
				'students' => $statistics
			]);
		} catch (\Throwable $th) {
			throw $th;
		}
    }

	public function detail(Request $req) :View
	{
		$test = $req->query('test');
		$user_id = $req->query('id');

		$abort = !in_array($test, ['wawancara', 'fisik', 'detail']);
		$abort = $abort or is_null($user_id) or empty($user_id);
		if ($abort) return redirect()->route('dashboard.statistic.index', ['test' => $test]);

		return view('pages.dashboard.statistic.detail', [

		]);
	}
}
