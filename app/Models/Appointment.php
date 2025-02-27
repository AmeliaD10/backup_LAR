<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Specify which fields are mass-assignable
    protected $fillable = [
        'name',
        'phone',
        'pet',
        'breed',
        'treatment',
        'petName',
        'time',
        'date',
        'status',
        'doctor_id',
        'clinic_id',
        'user_id',
        'appointment_date'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}