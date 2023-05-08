<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Nette\Utils\DateTime;

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
    public function appoint(Request $request, Clinic $clinic, Doctor $doctor)
    {
        $data = $request->all();
        $data['doctor_id'] = $doctor->id;
        $data['clinic_id'] = $clinic->id;
        if (DateTime::createFromFormat('Y-m-d H:i:s', $data['date']) !== false) {
            Appointment::create($data);
            $date = date_create($data['date']);

            return back()->with('success', 'Ваша заявка была успешно принята. <br> Явиться в ' . $clinic->address . ". <br> В назначенное время: " . $date->format('d.m.Y - H:i'));
        }
        return back()->with('error', 'Выберите дату!');
    }
}
