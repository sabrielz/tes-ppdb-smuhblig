<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];

    public function getRouteKeyName() :string { return 'id'; }

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'type_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsToMany(\App\Models\PPDB\Jurusan::class, env('DB_DATABASE') . '.jurusan_question');
    }

    public function scopeFilter($query, array $filters)
    {
        // FILTER JURUSAN $id
        $query->when($filters['jurusan'] ?? false, function ($query, $jurusan) {
            $query->whereHas('jurusan', function ($q) use ($jurusan) {
                return $q->where('jurusan_id', $jurusan);
            });
        });

        // FILTER TYPE $id
        $query->when($filters['type'] ?? false, function ($query, $type) {
            return $query->where('type_id', $type);
        });
    }
}
