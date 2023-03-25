<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
		use SoftDeletes;
    use HasFactory;

		protected $dates = ['deleted_at'];

		public function type()
		{
			return $this->belongsTo(QuestionType::class, 'type_id', 'id');
		}

		public function jurusan()
		{
			return $this->belongsToMany(Jurusan::class);
		}
}
