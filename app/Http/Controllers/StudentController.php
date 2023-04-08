<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchStudentResource;
use App\Models\PPDB\Identitas;
use Illuminate\Http\Request;

class StudentController extends Controller
{

	public function api (Request $req) {
		$students = null; $goal = null; $error = null; $status = 200;

		if ($req->query('search')) {
			$students = Identitas::whereRelation('jurusan', 'kode', 'like', '%'.request('search').'%')
				->orWhere('nama_lengkap', 'like', '%'.$req->query('search').'%')
				->orWhere('asal_sekolah', 'like', '%'.$req->query('search').'%')
				->whereRelation('verifikasi', 'daftar_ulang', true)
				->with(['jurusan'])->get()->toArray();
		}

		return response()->json([
			'data' => $students,
			'error' => $error,
			'status' => $status,
		]);
	}

	public function index (Request $req) {
		return view('pages.dashboard.student');
	}

	public function select (Request $req, Identitas $student) {
		dd($student);
	}

}
