<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
    'name',
    'email',
    'class',
    'roll_no',
    'phone',
    'father_name',
    'mother_name',
    'dob',
    'address',
    'religion',
    'citizenship',
    'photo_path',
];

public function results()
{
    return $this->hasMany(Result::class);
}


}
