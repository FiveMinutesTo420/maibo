<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function clinics()
    {
        return $this->hasMany(ClinicService::class, 'service_id');
    }
}
