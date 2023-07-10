<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AppointmentsAdministrationController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }

    public function AddAppointment(AddAppointmentRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                try {
                    Appointment::create(array_merge($request->only('idAppointmentType','date','place'),array('complete' => 0)));
                    Session::flash('Success','Ajout réussi');
                }catch (\Exception $e){
                    Session::flash('Failure','Une erreur est survenue');
                }
                return redirect()->back();
            }
        }
    }
}
