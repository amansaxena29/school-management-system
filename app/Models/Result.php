<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id',
        'exam_name',
        'year',
        'total_marks',
        'max_marks',
        'percentage',
        'status',
        'is_published',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subjects()
    {
        return $this->hasMany(ResultSubjectMark::class);
    }
}
