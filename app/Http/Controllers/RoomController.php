<?php

namespace App\Http\Controllers;

use App\Models\PPDB\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
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

	public function index(Request $req)
	{
		$kode_jurusan = strtoupper(request()->query('student'));
		$test_type = 'tes_' . $req->query('test');
		$questions = null;
		$allow = true;
		$bio = $student = null;

		if ($kode_jurusan) {
			$bio = $student = User::where('username', $kode_jurusan)->first();

			// dd($bio->identitas->verifikasi->daftar_ulang);
			if (!$bio) {
				$allow = false;
				alert(['warning' => "Maaf, siswa tidak ditemukan."]);
			} else if(!$bio->identitas->verifikasi->daftar_ulang) {
				$allow = false;
				alert(['warning' => "Maaf, siswa belum memenuhi syarat verifikasi."]);
			} else {
				$result = recollect($this->isBio($bio));
				if ($bio->status && $bio->status->$test_type) {
					$allow = false;
					alert(['warning' => "Siswa sudah melakukan tes ". request('test') ]);
				}
			}
		}

		if ($student and $student->status and $student->status->get($test_type, false) == true) {
			$allow = false;
			alert(['warning' => "Siswa sudah melakukan tes ". request('test') ]);
		}

		// Quick physics and uniform form
		if ($kode_jurusan && $test_type != 'wawancara') {
			try {
				$questions = Question::with(['type'])->whereRelation('type', 'slug', 'tes-'.$req->query('test'))->get();
			} catch (\Throwable $th) {
				$allow = false;
				alert(['warning' => 'Maaf terjadi kesalahan saat mengambil data soal.']);
			}
		}

		return view('pages.dashboard.loby', [
			'siswa' => $result ?? null,
			'student' => $student,
			'allow_test' => $allow,
			'questions' => $questions
		]);
	}
}
