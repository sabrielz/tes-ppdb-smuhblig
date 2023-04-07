<?php

namespace App\Http\Controllers;

use App\Models\PPDB\User;
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
		$allow = true;

		if ($kode_jurusan) {
			$bio = User::where('username', $kode_jurusan)->first();

			if (!$bio) {
				$allow = false;
				alert(['warning' => "Maaf, siswa tidak ditemukan."]);
			} else {
				$result = recollect($this->isBio($bio));
				if ($bio->status && $bio->status->$test_type) {
					$allow = false;
					alert(['warning' => "Siswa sudah melakukan tes ". request('test') ]);
				}
			}
		}

		return view('pages.dashboard.loby', [
			'siswa' => $result ?? null,
			'allow_test' => $allow
		]);
	}
}
