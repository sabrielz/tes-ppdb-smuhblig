<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanStudent extends Model
{
    use HasFactory;

		protected $connection = 'mysql1';
		protected $table = 'jurusans';

		public function identitas()
		{
			return $this->belongsTo(Identitas::class, 'identitas_id');
		}
}
