<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;

		protected $connection = 'mysql1';
		protected $table = 'verifikasis';
		protected $with = ['student'];

		public function student()
		{
			return $this->belongsTo(Student::class, 'identitas_id', 'id');
		}
}
