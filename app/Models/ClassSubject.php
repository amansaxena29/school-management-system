<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable = [
        'class',
        'exam_type',
        'subject',
        'max_marks',
        'sort_order',
        'is_active',
    ];
}
