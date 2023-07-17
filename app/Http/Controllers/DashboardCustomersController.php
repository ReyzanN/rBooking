<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DashboardCustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(){
        $Time = new \DateTime();
        $AppointmentOfDay = auth()->user()->GetAppointmentRegistrationOfDay();
        $AppointmentConfirmationPending = auth()->user()->GetPendingConfirmationAppointment();
        return view('customers.dashboard.index', ['Time' => $Time->format('d/m/Y - H:i'),'AppointmentOfDay' => $AppointmentOfDay, 'AppointmentConfirmationPending' => $AppointmentConfirmationPending]);
    }
}
