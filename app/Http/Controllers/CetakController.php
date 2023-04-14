<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\PPDB\User;
use Illuminate\Http\Request;

class CetakController extends Controller
{
	private function getWawancaraLaporan()
	{
		if (!request('status') || request('status') == 'sudah') {
			$result = Answer::whereRelation('question', 'type_id', 2)->whereHas('student', function($q) {
				$q->filter(request(['jurusan']));
			})->with(['student', 'question'])->get()->groupBy('student.name');
		} else if(request('status') == 'belum') {
			$result = User::where('level_id', 1)->filter(request(['jurusan']))->filter(['status' => request('status')])->whereHas('identitas', function($query) {
				return $query->whereRelation('verifikasi', 'daftar_ulang', true);
			})->with(['answers', 'identitas'])->orderBy('name')->get()->groupBy('name');
		}
		return $result;
	}

	private function getFisikLaporan()
	{
		if(!request('status') || request('status') == 'sudah') {
			$result = Answer::whereRelation('question', 'type_id', 1)->whereHas('student', function($q) {
				$q->filter(request(['jurusan']));
			})->with(['student', 'question'])->get()->groupBy('student.name');
		} else if(request('status') == 'belum') {
			$result = User::where('level_id', 1)->filter(request(['jurusan']))->filter(['status' => request('status')])->whereHas('identitas', function($query) {
				return $query->whereRelation('verifikasi', 'daftar_ulang', true);
			})->with(['answers', 'identitas'])->get()->groupBy('name');
		}
		return $result;
	}

	private function getSeragamLaporan() {
		$result = User::where('level_id', 1)->filter(request(['jurusan']))->filter(['ukur' => request('ukur') ?? 'sudah' ])->with(['answers', 'identitas'])->orderBy('name')->get()->groupBy('name');
		return $result;
	}

	public function index(Request $req)
	{
		$test = $req->query('test');
		$method_name = 'get' . ucfirst($test) . 'Laporan';
		$laporan = $this->$method_name();
		// dd($laporan);

		return view('pages.dashboard.cetak.index-'.$test, [
			'students' => $laporan,
			'title' => 'Laporan '.ucfirst($test)
		]);
	}
}
