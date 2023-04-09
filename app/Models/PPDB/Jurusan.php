<?php

namespace App\Models\PPDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jurusan extends Model
{
    use HasFactory;

		protected $connection = 'mysql1';
		protected $table = 'data_jurusans';
		public $timestamps = false;

		public function __construct(array $attributes = [])
		{
				$this->table = env('DB_DATABASE1').'.'.$this->table;
				parent::__construct();
		}

		public function questions()
		{
			// belongsToMany(Model, Database.Table);
			return $this->belongsToMany(\App\Models\Question::class, env('DB_DATABASE').'.jurusan_question');
		}
}
