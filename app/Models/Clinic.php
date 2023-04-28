<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClinicService;
use App\Models\ClinicDiagnostic;
use App\Models\Doctor;

class Clinic extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function type()
    {
        return $this->belongsTo(ClinicType::class, 'type_id');
    }
    public function services()
    {
        return $this->hasMany(ClinicService::class, 'clinic_id');
    }
    public function diagnostics()
    {
        return $this->hasMany(ClinicDiagnostic::class, 'clinic_id');
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'clinic_id');
    }
}
