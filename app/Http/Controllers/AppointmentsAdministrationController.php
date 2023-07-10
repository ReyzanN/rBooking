<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentRequest;
use App\Http\Requests\ForceRegistrationForUserRequest;
use App\Mail\ConfirmationForceRegistrationMail;
use App\Mail\ConfirmRegistrationMail;
use App\Models\Appointment;
use App\Models\AppointmentRegistration;
use App\Models\ToolBox;
use App\Models\User;
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

    public function ForceRegisterUser(ForceRegistrationForUserRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                $IdAppointment = $request->only(['idAppointment']);
                $IdUser = $request->only(['idUser']);
                if (!AppointmentRegistration::AppointmentRegistrationAlreadyExistForUser($IdAppointment,$IdUser)){
                    try {
                        $AppointmentRegistration = AppointmentRegistration::create(array_merge($request->only('idAppointment','idUser'),array('confirmed' => 1,'confirmed_at' => new \DateTime(),'active' => 1)));
                        $Appointment = Appointment::find($AppointmentRegistration->idAppointment)->first();
                        $Appointment->UpdateRegistration();
                        $Token = $AppointmentRegistration->GetToken(30);
                        $AppointmentRegistration->update(['confirmToken' => $Token]);
                        $Location = $AppointmentRegistration->GetAppointment()->GetAppointmentType()->streetNumber.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->street.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->zipCode.' '.$AppointmentRegistration->GetAppointment()->GetAppointmentType()->location;
                        Mail::to(User::find($request->only('idUser')))->send(new ConfirmationForceRegistrationMail($AppointmentRegistration,$Location));
                        Session::flash('Success', 'L\'utilisateur est inscrit');
                    }catch (\Exception) {
                        Session::flash('Failure','Une erreur est survenue');
                    }
                }else{
                    Session::flash('Failure','La personne est déjà inscrite');
                }
                return redirect()->back();
            }
        }
    }

    public function RemoveAppointment($IdAppointment){
        if (Gate::allows('UserAdmin')){
            $Appointment = Appointment::find($IdAppointment);
            if ($Appointment){
                try {
                    $Appointment->delete();
                    Session::flash('Success','Supprimé avec succès, les personnes inscrites ont été informées');
                }catch (\Exception $e){
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
    }
}
