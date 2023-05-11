<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Diagnostic;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $rmonth = date('m');

        $month = array("01" => 'Январь', "02" =>  'Февраль', "03" => 'Март', "04" => 'Апрель', "05" => 'Май', "06" => 'Июнь', "07" => 'Июль', "08" => 'Август', "09" => 'Сентябрь', "10" => 'Октябрь', "11" => 'Ноябрь', "12" => 'Декабрь');
        $clinic = Clinic::where('slug', $clinic)->first();
        return view('clinic', ['clinic' => $clinic, 'month' => $month[$rmonth]]);
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
    public function auth()
    {
        return view('auth');
    }
    public function authStore(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('home')->with('success', 'Вы успешно авторизовались');
        }

        return to_route('auth')->with('error', 'Неверный логин или пароль');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('home')->with('success', 'Вы успешно вышли');
    }
}
