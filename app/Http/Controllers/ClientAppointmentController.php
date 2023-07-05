<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use Illuminate\Http\Request;

class ClientAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke(){
        $AppointmentType = AppointmentType::GetActive();
        return view('customers.appointment.index', ['AppointmentType' => $AppointmentType]);
    }
}
