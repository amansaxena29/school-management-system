<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery'; // ← This tells Laravel to use 'gallery' not 'galleries'

    protected $fillable = ['image_path', 'caption', 'is_url'];
}
