<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'pet',
        'breed',
        'treatment',
        'pet_name',
        'time',
        'date',
    ];
}
