<?php

namespace App\Http\Controllers;

use App\Models\PPDB\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
		private function getWawancaraLaporan()
		{
			$result = User::where('level_id', 1)->filter(request(['search', 'sort', 'jurusan']))->filter(['status' => request('status') ?? 'sudah'])->whereHas('identitas', function($query) {
				return $query->whereRelation('verifikasi', 'daftar_ulang', true);
			})->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();
			return $result;
		}

		private function getFisikLaporan()
		{
			$result = User::where('level_id', 1)->filter(request(['search', 'sort', 'jurusan']))->filter(['status' => request('status') ?? 'sudah'])->whereHas('identitas', function($query) {
				return $query->whereRelation('verifikasi', 'daftar_ulang', true);
			})->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();
			return $result;
		}

		private function getSeragamLaporan() {
			$result = User::where('level_id', 1)->filter(request(['search', 'sort', 'jurusan']))->filter(['ukur' => request('ukur') ?? 'sudah'])->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();
			return $result;
		}

		public function index(Request $req)
		{
			$test = $req->query('test');
			$method_name = 'get' . ucfirst($test) . 'Laporan';
			$laporan = $this->$method_name();
			// dd($statistics);

			if($test == 'seragam') {
				return view('pages.dashboard.laporan.index-seragam', [
					'students' => $laporan
				]);
			}
			return view('pages.dashboard.laporan.index', [
				'students' => $laporan
			]);
		}
}
