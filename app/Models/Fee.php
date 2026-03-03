<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'class',
        'inst1_amount', 'inst1_date', 'inst1_status',
        'inst2_amount', 'inst2_date', 'inst2_status',
        'inst3_amount', 'inst3_date', 'inst3_status',
        'inst4_amount', 'inst4_date', 'inst4_status',
        'inst5_amount', 'inst5_date', 'inst5_status',
    ];

    protected $casts = [
        'inst1_date' => 'date',
        'inst2_date' => 'date',
        'inst3_date' => 'date',
        'inst4_date' => 'date',
        'inst5_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function totalPaid(): float
    {
        $total = 0;
        for ($i = 1; $i <= 5; $i++) {
            $status = "inst{$i}_status";
            $amount = "inst{$i}_amount";
            if ($this->$status === 'paid' && $this->$amount) {
                $total += (float) $this->$amount;
            }
        }
        return $total;
    }

    public function totalLogged(): float
    {
        $total = 0;
        for ($i = 1; $i <= 5; $i++) {
            $amount = "inst{$i}_amount";
            if ($this->$amount) {
                $total += (float) $this->$amount;
            }
        }
        return $total;
    }
}
