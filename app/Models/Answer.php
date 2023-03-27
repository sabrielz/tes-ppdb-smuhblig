<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

		protected $dates = ['deleted_at'];

		public function question()
		{
			return $this->belongsTo(Question::class, 'question_id', 'id');
		}

		public function student()
		{
			return $this->belongsTo(Student::class, 'student_id', 'id');
		}
}
