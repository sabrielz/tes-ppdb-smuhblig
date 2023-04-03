<?php

namespace App\Http\Controllers;

use App\Models\PPDB\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{

		public function isBio($bio)
		{
			if($bio) {
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
        // $siswa = null;

        // if ($req->get('student', null)) {
        //     $siswa = [
        //         'nama' => 'Example',
        //         'asal_sekolah' => 'Example',
        //     ];
        // }

				// $details = [];

				$bio = User::where('username', request('student'))->first();

				$result = $this->isBio($bio);

        return view('pages.dashboard.loby', [
            'siswa' => $result ?? null
        ]);
    }
}
