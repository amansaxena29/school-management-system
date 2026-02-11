<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
        protected $fillable = [
            'student_name',
            'father_name',
            'amount',
            'status',
            'class'
        ];
}
