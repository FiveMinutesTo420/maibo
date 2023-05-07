<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\ClinicType;
use App\Models\Service;
use Illuminate\Support\Str;

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
        return view('admin.add.doctorAdd', compact('clinics'));
    }
    public function docAddOk(Request $request)
    {
        $data = $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'clinic_id' => 'required',
            'experience' => 'required',
        ]);
        if (Doctor::create($data)) {
            return to_route('admin');
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
        return view('admin.change.doctorChange', compact('doctor', 'clinics'));
    }
    public function docEditOk(Request $request, Doctor $doctor)
    {
        $data = $request->all();
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
        return view('admin.add.clinicAdd', compact('types'));
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
        return view('admin.change.clinicChange', compact('types', 'clinic'));
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
}
