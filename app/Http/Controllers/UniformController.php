<?php

namespace App\Http\Controllers;

use App\Models\PPDB\Seragam;
use Illuminate\Http\Request;

class UniformController extends Controller
{
    public function index () {
		return redirect()->route('');
	}

	public function update (Request $req, Seragam $uniform) {
		dd($uniform);
	}
}
