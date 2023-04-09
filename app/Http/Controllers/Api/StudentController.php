<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentDetailResource;
use App\Models\PPDB\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiStudentController extends Controller
{

	/**
	 * Get student detail from kode_jurusan
	 */
	public function detail (Request $req) {
		try {

			$creden = $req->validate([
				'user_id' => 'required'
			]);

			$user = User::findOrFail($creden['user_id']);
			return response(new StudentDetailResource($user), 200);

		} catch (\Throwable $th) {
			return response([
				'error' => true,
				'reason' => $th->getMessage()
			]);
		}
	}

}
