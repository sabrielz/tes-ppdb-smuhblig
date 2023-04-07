<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PPDB\Identitas;
use Illuminate\Http\Request;

class DetailStatisticController extends Controller
{
    public function index(Request $req)
		{
			$data = Identitas::find($req->id);

			return response()->json([
				'message' => 'Success',
				'data' => $data
			], 200);
		}
}
