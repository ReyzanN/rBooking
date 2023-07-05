<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['AdministrationMember']);
    }

    public function ViewUsersList(){
        $Users = User::all();
        $UsersCount = count($Users);
        return view('admin.users.index', ['Users' => $Users,'UserCount' => $UsersCount]);
    }
}
