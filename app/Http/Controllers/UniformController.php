<?php

namespace App\Http\Controllers;

use App\Models\PPDB\DataSeragam;
use App\Models\PPDB\Identitas;
use App\Models\PPDB\Seragam;
use App\Models\PPDB\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UniformController extends Controller
{
	public function isBio($bio) :array
	{
		if ($bio) {
			// $details['test_type'] = Str::title(request()->get('test'));
			$details['jurusan'] = Str::upper($bio->identitas->jurusan->nama);
			$details['kode_pendaftaran'] = $bio->identitas->jurusan->kode;
			$details['nama_lengkap'] = $bio->identitas->nama_lengkap;
			$details['jenis_kelamin'] = $bio->identitas->jenis_kelamin->label;
			$details['asal_sekolah'] = $bio->identitas->asal_sekolah;
			$details['no_wa'] = $bio->identitas->no_wa_siswa;
			return $details;
		}
		return $details = [];
	}

	public function index ()
	{
		$result = User::where('level_id', 1)->filter(request(['search', 'sort']))->whereHas('identitas', function($query) {
			return $query->whereRelation('verifikasi', 'daftar_ulang', true);
		})->with(['answers', 'identitas'])->groupBy('identitas_id')->paginate(15)->withQueryString();

		return view('pages.dashboard.uniform.index', [
			'students' => $result
		]);
	}

	/**
	 * Edit student uniform
	 */
	public function edit (Request $req)
	{
		$kode_jurusan = $req->query('student');
		$student = null; $questions = null;
		$allow = true;

		if ($kode_jurusan) {
			$student = User::where('username', $kode_jurusan)->first();
			$result = recollect($this->isBio($student));

			try {
				$questions = DataSeragam::all();
			} catch (\Throwable $th) {
				$allow = false;
				alert(['warning' => 'Maaf, terjadi kesalahan saat mengambil data soal.']);
			}
		}


		return view('pages.dashboard.uniform.edit', [
			'siswa' => $result ?? null,
			'student' => $student,
			'allow_test' => $allow,
			'questions' => $questions
		]);
	}

	public function update (Request $req, Seragam $uniform) {
		// dd($req->all());

		$validData = $req->validate([
			'ukuran_wearpack' => 'required',
			'ukuran_olahraga' => 'required',
			'ukuran_almamater' => 'required'
		]);

		$uniform->update($validData);

		// dd($uniform->identitas->verifikasi());

		$uniform->identitas->verifikasi()->update([
			'seragam' => true,
			'tanggal_seragam' => now(),
			'admin_seragam_id' => auth()->user()->id
		]);

		alert(['success' => 'Berhasil menyimpan data seragam.']);
		return redirect()->route('dashboard.uniform.index');
	}
}
