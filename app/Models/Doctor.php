<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DoctorSpeciality;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function specialities()
    {
        return $this->hasMany(DoctorSpeciality::class, 'doctor_id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
    public function hasSpeciality($id)
    {
        foreach ($this->specialities as $s) {
            if ($s->id == $id) {
                return true;
            }
        }
    }
}
