<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentRequest;
use App\Mail\ConfirmRegistrationMail;
use App\Models\Appointment;
use App\Models\AppointmentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
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

    public function test(){
        $AppointmentRegistration = AppointmentRegistration::find(1)->first();
        $Location = $AppointmentRegistration->GetAppointment()->GetAppointmentType()->streetNumber.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->street.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->zipCode.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->location;
        Mail::to(auth()->user())->send(new ConfirmRegistrationMail($AppointmentRegistration,$Location));
    }

    public function preview(){
        $AppointmentRegistration = AppointmentRegistration::find(1)->first();
        $Location = $AppointmentRegistration->GetAppointment()->GetAppointmentType()->streetNumber.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->street.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->zipCode.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->location;
        return view('emails.registration.confirmRegistration',['AppointmentRegistration' => AppointmentRegistration::find(1)->first(),'LocationComplete' => $Location]);
    }
}
