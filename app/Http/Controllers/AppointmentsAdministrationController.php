<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentRequest;
use App\Http\Requests\ForceRegistrationForUserRequest;
use App\Http\Requests\UpdateAppointmentRequest;
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

    public function UpdateAppointment(UpdateAppointmentRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                $Appointment = Appointment::find($request->only(['idAppointment']))->first();
                if ($Appointment){
                    try {
                        $Appointment->update($request->only('date','place'));
                        $Appointment->UpdateRegistration();
                        Session::flash('Success','Modification réalisée avec succès');
                    }catch (\Exception $e){
                        Session::flash('Failure','Une erreur est survenue');
                    }
                }
            }
        }
        return redirect()->back();
    }

    public function ViewAppointment($IdAppointment){
        $Appointment = Appointment::find($IdAppointment);
        if (!$Appointment){
            Session::flash('Failure','Ce rendez-vous n\'existe pas');
            return redirect()->back();
        }
        return view('admin.appointment.view', ['Appointment' => $Appointment]);
    }

    public function ArchiveAppointment($IdAppointment){
        if (Gate::allows('UserAdmin')) {
            $Appointment = Appointment::find($IdAppointment);
            if (!$Appointment) {
                Session::flash('Failure', 'Ce rendez-vous n\'existe pas');
                return redirect()->back();
            }
            try {
                $AppointmentRegistration = $Appointment->GetAppointmentRegistration();
                foreach ($AppointmentRegistration as $Registration) {
                    $Registration->update(['active' => 0, 'present' => 0]);
                }
                $Appointment->update(['active' => 0]);
                Session::flash('Success', 'Archivé');
            } catch (\Exception $e) {
                Session::flash('Une erreur est survenue');
            }
        }
        return redirect()->back();
    }

    public function UpdateStatusRegistration($IdRegistration,$Value){
        $Registration = AppointmentRegistration::find($IdRegistration);
        if (!$Registration){
            Session::flash('Failure', 'Ce rendez-vous n\'existe pas');
            return redirect()->back();
        }
        if ($Value){
            try {
                $Registration->SetPresent();
                Session::flash('Success','Status actualisé');
            }catch (\Exception $e){
                Session::flash('Failure','Une erreur est survenue');
            }

        }else{
            try {
                $Registration->SetNonPresent();
                Session::flash('Success','Status actualisé');
            }catch (\Exception $e){
                Session::flash('Failure','Une erreur est survenue');
            }

        }
        return redirect()->back();
    }
}
