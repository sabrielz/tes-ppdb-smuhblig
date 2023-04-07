<?php

namespace App\Models;

use App\Models\PPDB\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'question_id',
        'answer'
    ];
    protected $dates = ['deleted_at'];

		protected $with = ['question'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function question_type()
    {
        return $this->hasOneThrough(QuestionType::class, Question::class, 'type_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

		public function scopeFilter($query, array $filters)
		{
			$query->when($filters['name'] ?? false, function($query, $name) {
				if($name == 'asc') {
					return $query->orderBy('student.nama_lengkap', 'asc');
				} else if($name == 'desc') {
					return $query->orderBy('student.nama_lengkap', 'desc');
				}
			});

			$query->when($filters['lahir'] ?? false, function($query, $lahir) {
				if($lahir == 'asc') {
					return $query->orderBy('student.tanggal_lahir', 'asc');
				} else if($lahir == 'desc') {
					return $query->orderBy('student.tanggal_lahir', 'desc');
				}
			});
		}
}
