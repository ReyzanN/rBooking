<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }
    public function __invoke(){
        return view('admin.dashboard.index');
    }
}
