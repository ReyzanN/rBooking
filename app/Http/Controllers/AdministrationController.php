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
    

    /*
     * Ajax Functions
     */

    public function ViewUserAjaxForModal(Request $request){
        if ($request->ajax()){
            $User = User::find($request->only('data')['data']);
            if (!$User){
                return view('admin.users.error');
            }
            return view('admin.users.modalViewUser', ['User' => $User]);
        }
    }
}
