<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.login');
    }

		public function login(Request $req)
		{
			$creden = $req->validate([
				'username' => 'required',
				'password' => 'required'
			]);
	
			if(Auth::attempt($creden)) {
				$req->session()->regenerate();
				
				return redirect(route('dashboard.index'));
			}

			return;
		}

    public function logout()
    {
        try {
            auth()->logout();
            session()->invalidate();
            session()->regenerate();
            alert([
                [
                    'variant' => 'success',
                    'message' => 'Logout berhasil.'
                ]
            ]);
        } catch (\Throwable $th) {
            alert([
                ['variant' => 'danger', 'message' => 'Maaf, terjadi error saat mencoba logout.']
            ]);
        } finally {
            return redirect( route('index') );
        }
    }

}
