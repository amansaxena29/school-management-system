<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultSubjectMark extends Model
{
    protected $table = 'result_subject_marks';

    protected $fillable = [
        'result_id',
        'subject',
        'marks',
        'max_marks',
        'grade',
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }
}
