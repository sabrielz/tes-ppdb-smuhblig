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
	private function getWawancaraStatistic()
	{
		// $result = Answer::whereRelation('question', 'type_id', 2)->with(['student', 'question'])->paginate(15);
		// $result->setCollection($result->groupBy('student'));
		$result = User::where('level_id', 1)->filter(request(['search', 'sort']))->has('identitas')->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();
		// dd($result);
		return $result;
	}

	private function getFisikStatistic()
	{
		// $result = Answer::whereRelation('question', 'type_id', 1)->with(['student', 'question'])->paginate(15);
		// $result->setCollection($result->groupBy('student'));
		$result = User::where('level_id', 1)->filter(request(['search', 'sort']))->has('identitas')->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();
		return $result;
	}

	private function getFisikStudentAnswer($id)
	{
		return Answer::whereRelation('student', 'username', $id)->whereRelation('question', 'type_id', 1)->get();
	}

	private function getWawancaraStudentAnswer($id)
	{
		return Answer::whereRelation('student', 'username', $id)->whereRelation('question', 'type_id', 2)->get();
	}

	public function index(Request $req): View
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

	public function detail(Request $req): View
	{
		$test = $req->query('test');
		$id = $req->query('student');
		$method_name = 'get' . ucfirst($test) . 'StudentAnswer';
		$data = $this->$method_name($id);
		// dd($data);
		// $test = $req->query('test');
		// $identitas_id = $req->query('id');

		// $abort = !in_array($test, ['wawancara', 'fisik', 'detail']);
		// $abort = $abort or is_null($identitas_id) or empty($identitas_id);
		// if ($abort) return redirect()->route('dashboard.statistic.index', ['test' => $test]);

		return view('pages.dashboard.statistic.detail', [
			'questions' => $data
		]);
	}
}
