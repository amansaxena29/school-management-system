<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarksheetExtra extends Model
{
    protected $fillable = [
        'student_id',
        'session',
        'class',

        'attendance',
        'promoted_to_class',
        'class_teacher_remarks',

        'discipline_term1',
        'discipline_term2',

        'art_education_term1',
        'art_education_term2',

        'general_awareness_term1',
        'general_awareness_term2',

        'health_physical_term1',
        'health_physical_term2',
    ];
}
