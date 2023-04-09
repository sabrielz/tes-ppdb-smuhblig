<?php

namespace App\Http\Controllers;

use App\Models\PPDB\DataSeragam;
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
			} else if(!$bio->identitas->verifikasi->seragam) {
				$allow = false;
				alert(['warning' => "Maaf, sudah melakukan pengukuran seragam."]);
			} else {
				$result = recollect($this->isBio($bio));
				if ($bio->status && $bio->status->$test_type) {
					$allow = false;
					alert(['warning' => "Siswa sudah melakukan tes ". request('test') ]);
				}
			}
		}

		// Quick physics and uniform form
		// if ($kode_jurusan && $test_type != 'wawancara') {
			try {
				$questions = DataSeragam::all();
			} catch (\Throwable $th) {
				$allow = false;
				alert(['warning' => 'Maaf terjadi kesalahan saat mengambil data soal.']);
			}
		// }

		return view('pages.dashboard.uniform', [
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
