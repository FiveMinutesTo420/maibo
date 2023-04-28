<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicService extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function clinic()
    {
        return $this->belongsTo(Clinic::class, 'clinic_id');
    }
}
