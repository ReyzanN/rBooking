<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmRegistrationMail;
use App\Models\Appointment;
use App\Models\AppointmentRegistration;
use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ClientAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('ConfirmAppointment');
    }

    public function __invoke(){
        $AppointmentType = AppointmentType::GetActive();
        return view('customers.appointment.index', ['AppointmentType' => $AppointmentType]);
    }

    public function ViewAppointmentType($IdAppointmentType){
        $AppointmentType = AppointmentType::find($IdAppointmentType);
        if (!$AppointmentType){
            Session::flash('Failure,','Ce type de rendez-vous n\'existe pas');
            return redirect()->back();
        }
        $Appointment = $AppointmentType->GetActiveAppointment();
        foreach ($Appointment as $A){
            $Registration = $A->GetAppointmentRegistration();
            foreach ($Registration as $R){
                $R->UpdateValidity();
            }
        }
        return view('customers.appointment.viewType',['AppointmentType' => $AppointmentType, 'Appointment' => $Appointment]);
    }

    public function RegisterForAppointment($IdAppointment){
        $Appointment = Appointment::find($IdAppointment);
        if (!$Appointment) {
            Session::flash('Failure','Ce rendez-vous n\'existe pas !');
            return redirect()->back();
        }
        if ($Appointment->IsFull()){
            Session::flash('Failure','Ce rendez-vous est complet');
            return redirect()->back();
        }
        try {
            $Registration = AppointmentRegistration::create([
                'idAppointment' => $Appointment->id,
                'idUser' => auth()->user()->id,
                'active' => 1,
                'status' => 1
            ]);
            $Token = $Registration->GetToken(30);
            $Registration->update(['confirmToken' => $Token]);
            $Appointment->UpdateRegistration();
            Mail::to(auth()->user())->send(new ConfirmRegistrationMail($Registration, $Appointment->GetLocation()));
            Session::flash('Success','Inscription enregistrée, merci de la confirmer avec le lien transmis par email');
        }catch (\Exception $e){
            Session::flash('Failure', 'Une erreur est survenue');
        }
        return redirect()->back();
    }

    public function ConfirmAppointment($Token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $AppointmentRegistration = AppointmentRegistration::where(['confirmToken' => $Token])->get()->first();
        if (!$AppointmentRegistration) {
            Session::flash('Failure','Cette confirmation ne correspond à aucun rendez-vous');
            return redirect()->route('customer.dashboard');
        }
        $Created_at = new \DateTime($AppointmentRegistration->created_at);
        $DateConfirmationExpiration = new \DateTime(date('Y-m-d H:i:s', strtotime($Created_at->format('Y-m-d H:i:s'). '15 minutes')));
        if($DateConfirmationExpiration > new \DateTime()) {
            try {
                $AppointmentRegistration->update(['confirmed' => 1, 'confirmed_at' => new \DateTime(), 'status' => 2]);
                Session::flash('Success', 'Votre rendez-vous est confirmé, Merci !');
            } catch (\Exception $e) {
                Session::flash('Failure', 'Une erreur est survenue');
            }
        }else {
            $AppointmentRegistration->SoftDelete();
            Session::flash('Failure','Le rendez-vous à expiré.');
        }
        return view('guest.confirmation');
    }
}
