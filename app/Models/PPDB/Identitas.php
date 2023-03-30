<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;

		protected $connection = 'mysql1';
		protected $table = 'identitas';

		public function verifikasi()
		{
			return $this->hasOne(Verifikasi::class, 'id', 'identitas_id');
		}

		public function user()
		{
			return $this->hasOne(User::class, 'id', 'identitas_id');
		}
}
