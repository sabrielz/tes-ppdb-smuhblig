<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionType extends Model
{
    use HasFactory, SoftDeletes;
		protected $dates = ['deleted_at'];

		public function questions()
		{
			return $this->hasMany(Question::class, 'id', 'type_id');
		}
}
