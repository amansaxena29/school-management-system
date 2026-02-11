<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'qualification',
        'experience',
        'phone',
        'doj',
        'email'
    ];

     protected $casts = [
        'doj' => 'date',
    ];
}
