<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\ClinicType;
use App\Models\ClinicService;

use App\Models\Service;
use App\Models\Speciality;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\DoctorSpeciality;
use App\Models\User;

class AdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $doctors = Doctor::orderByDesc('id')->get();
        $clinics = Clinic::orderByDesc('id')->get();
        $services = Service::orderByDesc('id')->get();
        $appointments = Appointment::orderByDesc('id')->get();
        return view('admin.admin', compact('doctors', 'clinics', 'appointments', 'services'));
    }
    public function docAdd(Request $request)
    {
        $doctors = Doctor::orderByDesc('id')->get();
        $clinics = Clinic::orderByDesc('id')->get();
        $services = Service::orderByDesc('id')->get();
        $appointments = Appointment::orderByDesc('id')->get();
        $specs = Speciality::orderByDesc('id')->get();
        return view('admin.add.doctorAdd', compact('clinics', 'specs'));
    }
    public function docAddOk(Request $request)
    {
        $data = $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'clinic_id' => 'required',
            'experience' => 'required',
            'specialities' => 'required'
        ]);
        $specs = $data['specialities'];
        unset($data['specialities']);

        if ($doc = Doctor::create($data)) {
            foreach ($specs as $s) {
                DoctorSpeciality::create([
                    'doctor_id' => $doc->id,
                    'speciality_id' => $s
                ]);
            }
            return to_route('admin');
        }
    }
    public function AddDoctorClinic(Request $request, Clinic $clinic)
    {

        $data = $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'experience' => 'required',
            'specialities' => 'required'
        ]);
        $data['clinic_id'] = $clinic->id;
        $specs = $data['specialities'];
        unset($data['specialities']);

        if ($doc = Doctor::create($data)) {
            foreach ($specs as $s) {
                DoctorSpeciality::create([
                    'doctor_id' => $doc->id,
                    'speciality_id' => $s
                ]);
            }
            return back()->with('success', 'Специалист был добавлен');
        }
    }
    public function DoctorDelete(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('success', "Доктор был удален");
    }
    public function docEdit(Request $request, Doctor $doctor)
    {
        $doctors = Doctor::orderByDesc('id')->get();
        $clinics = Clinic::orderByDesc('id')->get();
        $services = Service::orderByDesc('id')->get();
        $appointments = Appointment::orderByDesc('id')->get();
        $specs = Speciality::orderByDesc('id')->get();
        return view('admin.change.doctorChange', compact('doctor', 'clinics', 'specs'));
    }
    public function docEditOk(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'clinic_id' => 'required',
            'experience' => 'required',
            'specialities' => 'required'
        ]);
        $specs = $data['specialities'];
        unset($data['specialities']);
        foreach ($doctor->specialities as $sps) {
            $sps->delete();
        }
        foreach ($specs as $s) {
            DoctorSpeciality::create([
                'doctor_id' => $doctor->id,
                'speciality_id' => $s
            ]);
        }
        $doctor->update($data);
        $doctor->save();
        return back()->with('success', "Данные специалиста были редактированы");
    }
    public function serviceAdd()
    {
        return view('admin.add.serviceAdd');
    }
    public function serviceStore(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        Service::create($data);
        return back()->with('success', 'Услуга была добавлена');
    }
    public function serviceUpdate(Request $request, Service $service)
    {

        return view('admin.change.serviceChange', compact('service'));
    }
    public function serviceUpdateStore(Request $request, Service $service)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $service->update($data);
        $service->save();
        return back()->with('success', 'Услуга была редактирована');
    }
    public function deleteService(Service $service)
    {
        $service->delete();
        return back()->with('success', "Услуга была удалена");
    }
    public function addClinic()
    {
        $types = ClinicType::all();
        $users = User::orderByDesc('id')->get();
        return view('admin.add.clinicAdd', compact('types', 'users'));
    }
    public function StoreClinic(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        Clinic::create($data);
        return back()->with('success', "Клиника была успешно добавлена");
    }
    public function changeClinic(Clinic $clinic)
    {
        $types = ClinicType::all();
        $services = Service::orderByDesc('id')->get();
        $specs = Speciality::all();
        return view('admin.change.clinicChange', compact('types', 'clinic', 'services', 'specs'));
    }
    public function StoreServiceClinic(Request $request, Clinic $clinic)
    {
        $data = $request->all();
        $data['clinic_id'] = $clinic->id;
        ClinicService::create($data);
        return back()->with('success', 'Услуга была добавлена');
    }
    public function UpdateStoreClinic(Request $request, Clinic $clinic)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $clinic->update($data);
        return back()->with('success', "Клиника была успешно обновлена");
    }
    public function deleteClinic(Clinic $clinic)
    {
        $clinic->delete();
        return back()->with('success', "Клиника была удалена");
    }
    public function deleteApp(Appointment $app)
    {
        $app->delete();
        return back()->with("success", "Запись была удалена");
    }
    public function UpdateApp(Appointment $app)
    {
        $doctors = Doctor::orderByDesc('id')->get();

        return view('admin.change.appChange', compact('app', 'doctors'));
    }
    public function UpdateStoreApp(Request $request, Appointment $app)
    {
        $data = $request->all();
        $data['clinic_id'] = Doctor::where('id', $data['doctor_id'])->first()->clinic->id;
        $app->update($data);
        $app->save();
        return back()->with('success', 'Запись была редактирована');
    }
    public function reg()
    {
        return view('admin.reg');
    }
    public function regStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'email' => 'required|unique:users',
            'login' => 'required|unique:users|min:5',
            'password' => 'required|min:5',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return back()->with('success', "Пользователь был успешно добавлен!");
    }
}
