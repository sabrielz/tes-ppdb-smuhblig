<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('pages.login');
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
