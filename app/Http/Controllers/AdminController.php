<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Service;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $doctors = Doctor::all();
        $clinics = Clinic::all();
        $services = Service::all();
        $appointments = Appointment::all();
        return view('admin.admin', compact('doctors', 'clinics', 'appointments', 'services'));
    }
}
