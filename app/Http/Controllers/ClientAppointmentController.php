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
        $this->middleware(['auth'])->except('ConfirmAppointment','UnConfirmAppointment');
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
        $Appointment = $AppointmentType->GetActiveAppointmentForBooking();
        foreach ($Appointment as $A){
            $Registration = $A->GetAppointmentRegistration();
            foreach ($Registration as $R){
                $R->UpdateValidity();
            }
        }
        return view('customers.appointment.viewType',['AppointmentType' => $AppointmentType, 'Appointments' => $Appointment]);
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
        if ($AppointmentRegistration->confirmed_at === null) {
            $Created_at = new \DateTime($AppointmentRegistration->created_at);
            $DateConfirmationExpiration = new \DateTime(date('Y-m-d H:i:s', strtotime($Created_at->format('Y-m-d H:i:s') . '15 minutes')));
            if ($DateConfirmationExpiration > new \DateTime()) {
                try {
                    $AppointmentRegistration->update(['confirmed' => 1, 'confirmed_at' => new \DateTime(), 'status' => 2]);
                    Session::flash('Success', 'Votre rendez-vous est confirmé, Merci !');
                } catch (\Exception $e) {
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            } else {
                $AppointmentRegistration->SoftDelete();
                Session::flash('Failure', 'Le rendez-vous à expiré.');
            }
        }else {
            Session::flash('Failure', 'Ce token est expiré');
        }
        return view('guest.confirmation');
    }

    public function UnConfirmAppointment($Token): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $AppointmentRegistration = AppointmentRegistration::where(['confirmToken' => $Token])->get()->first();
        if (!$AppointmentRegistration) {
            Session::flash('Failure','Cette confirmation ne correspond à aucun rendez-vous');
            return redirect()->route('customer.dashboard');
        }
        if ($AppointmentRegistration->confirmed_at === null) {
            $Created_at = new \DateTime($AppointmentRegistration->created_at);
            $DateConfirmationExpiration = new \DateTime(date('Y-m-d H:i:s', strtotime($Created_at->format('Y-m-d H:i:s') . '15 minutes')));
            if ($DateConfirmationExpiration > new \DateTime()) {
                try {
                    $AppointmentRegistration->update(['confirmed' => 0, 'confirmed_at' => new \DateTime(), 'status' => 3]);
                    $AppointmentRegistration->SoftDelete();
                    Session::flash('Success', 'Votre rendez-vous est dé-confirmé, Merci !');
                } catch (\Exception $e) {
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            } else {
                $AppointmentRegistration->SoftDelete();
                Session::flash('Failure', 'Le rendez-vous à déjà expiré.');
            }
        }else {
            Session::flash('Failure', 'Ce token est expiré');
        }
        return view('guest.confirmation');
    }

    public function ViewMyAppointment($IdRegistration){
        $Registration = AppointmentRegistration::FindForUser($IdRegistration);
        if (!$Registration){
            Session::flash('Failure','Ce rendez-vous n\'existe pas');
            return redirect()->back();
        }
        return view('customers.appointment.viewMyAppointment', ['Registration' => $Registration]);
    }

    public function CancelAppointment($IdRegistration){
        $Registration = AppointmentRegistration::FindForUser($IdRegistration);
        if (!$Registration){
            Session::flash('Failure','Ce rendez-vous n\'existe pas');
            return redirect()->back();
        }
        if (!$Registration->confirmed){
            Session::flash('Failure','Pour annuler ce rendez-vous, merci d\'utiliser le lien reçu par email');
            return redirect()->back();
        }
        if ($Registration->status == 3 || $Registration->active = 0){
            Session::flash('Failure','Ce rendez-vous n\'est plus modifiable');
            return redirect()->back();
        }
        try {
            $Registration->SoftDelete();
            Session::flash('Success', 'Votre rendez-vous est annulé');
        }catch (\Exception $e){
            Session::flash('Failure', 'Une erreur est survenue');
        }
        return redirect()->back();
    }
}
