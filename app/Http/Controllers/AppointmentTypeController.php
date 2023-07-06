<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentTypeRequest;
use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AppointmentTypeController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }

    public function __invoke(){
        $Appointment = AppointmentType::all();
        $AppointmentActive = AppointmentType::where(['active' => 1])->get();
        $AppointmentCount = count($Appointment);
        $AppointmentCountActive = count($AppointmentActive);
        return view('admin.appointment.type.index', ['AppointmentType' => $Appointment, 'AppointmentTypeCount' => $AppointmentCount,'AppointmentTypeCountActive' => $AppointmentCountActive]);
    }

    public function AddAppointmentType(AddAppointmentTypeRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                try {
                    AppointmentType::create(array_merge($request->only('name','description','location','street','streetNumber','zipCode'),array('active' => 1)));
                    Session::flash('Success','Ajout réussi');
                }catch (\Exception $e){
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
    }

    public function ViewAppointmentType(int $AppointmentType){
        $AppointmentTypeSearch = AppointmentType::find($AppointmentType);
        if (!$AppointmentTypeSearch) {
            Session::flash('Failure', 'Ce type de rendez-vous n\'existe pas');
            return redirect()->back();
        }
        return view('admin.appointment.type.viewType', ['AppointmentType' => $AppointmentTypeSearch]);
    }
}
