<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $doctors = Speciality::limit(10)->get();
        $services = Service::all();
        $diagnostis = Diagnostic::limit(9)->get();
        return view('welcome', compact('doctors', 'services', 'diagnostis'));
    }
    public function doctors(Request $request)
    {
        $doctors = Doctor::orderByDesc('id')->get();
        $specialities = Speciality::all();

        if ($request->has('speciality')) {
            if ($request->speciality != 'all') {
                $doctorsWithSpec = [];
                foreach ($doctors as $d) {
                    foreach ($d->specialities as $sp) {
                        if ($sp->speciality->id == $request->speciality) {
                            array_push($doctorsWithSpec, $d);
                            break;
                        }
                    }
                }
                return view('doctors', [
                    'doctors' => $doctorsWithSpec,
                    'specialities' => $specialities
                ]);
            }
        }
        return view('doctors', compact('doctors', 'specialities'));
    }
    public function clinics(Request $request)
    {
        $clinics = Clinic::orderByDesc('id')->get();
        return view('clinics', compact('clinics'));
    }
    public function clinic(Request $request, $clinic)
    {
        $clinic = Clinic::where('slug', $clinic)->first();
        return view('clinic', compact('clinic'));
    }
    public function service(Request $request, $service)
    {
        $servicea = Service::where('slug', $service)->first();
        return view('service', ['service' => $servicea]);
    }
}
