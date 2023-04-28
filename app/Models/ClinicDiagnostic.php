<?php

namespace App\Models;

use App\Models\Clinic;
use App\Models\Diagnostic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicDiagnostic extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class, 'diagnostic_id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
