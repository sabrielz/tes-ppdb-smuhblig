<?php

namespace App\Models;

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

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function question_type()
    {
        return $this->hasOneThrough(QuestionType::class, Question::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
