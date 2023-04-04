<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

		if (Auth::attempt($creden)) {
			$req->session()->regenerate();

			return redirect(route('dashboard.index'));
		}

		if (Auth::attempt($creden)) {
			$req->session()->regenerate();

			alert(['success' => 'Login berhasil.']);
			return redirect(route('dashboard.index'));
		}

		return back();
	}

	public function logout(Request $req)
	{
		try {
			Auth::logout();
			$req->session()->invalidate();
			$req->session()->regenerateToken();
			alert(['success' => 'Logout berhasil.']);
		} catch (\Throwable $th) {
			alert(['danger' => 'Maaf, terjadi error saat mencoba logout.']);
		} finally {
			return redirect('/login');
		}
	}
}
