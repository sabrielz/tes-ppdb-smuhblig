<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanStudent extends Model
{
    use HasFactory;

		protected $connection = 'mysql1';
		protected $table = 'jurusans';
		
		public function __construct(array $attributes = [])
		{
				$this->table = env('DB_DATABASE1').'.'.$this->table;
				parent::__construct();
		}

		public function identitas()
		{
			return $this->belongsTo(Identitas::class, 'identitas_id');
		}
}
