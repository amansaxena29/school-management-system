<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'body', 'type', 'expires_at', 'is_active'];

    protected $casts = [
        'expires_at' => 'date',
        'is_active'  => 'boolean',
    ];

    // Only active, non-expired announcements
    public static function active()
    {
        return static::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', now()->toDateString());
            })
            ->latest()
            ->get();
    }
}
