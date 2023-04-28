<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Speciality::class, 'doctor_id');
    }
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
}
