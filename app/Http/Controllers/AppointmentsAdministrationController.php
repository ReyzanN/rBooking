<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentsAdministrationController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }
}
