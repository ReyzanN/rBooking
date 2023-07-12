<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }
    public function __invoke(){
        $AppointmentList = Appointment::GetAppointmentForDay();
        return view('admin.dashboard.index', ['AppointmentType' => $AppointmentList]);
    }
}
