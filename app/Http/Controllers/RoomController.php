<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $req)
    {
        $siswa = null;

        if ($req->get('siswa', null)) {
            $siswa = [
                'nama' => 'Example',
                'asal_sekolah' => 'Example',
            ];
        }

        return view('pages.dashboard.loby', [
            'siswa' => $siswa
        ]);
    }
}
