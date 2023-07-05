<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockingRequest;
use App\Http\Requests\UpdateUserRankRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function UpdateUserRank(UpdateUserRankRequest $request){
        if ($request->validated()){
            $User = User::find($request->only('user')['user']);
            if (!$User) {Session::flash('Failure', 'Utilisateur inconnue');}
            try {
                if (auth()->user()->id == $User->id) {
                    Session::flash('Failure','Vous ne pouvez pas modifier votre compte');
                    return redirect()->back();
                }
                if (env('APP_DEFAULT_ACCOUNT') == $User->id){
                    Session::flash('Failure','Vous ne pouvez pas modifier le compte par défaut');
                    return redirect()->back();
                }
                $User->update(['rank' => $request->only('rank')['rank']]);
                Session::flash('Success', 'Modification réalisée avec succès');
            }catch (\Exception $e){
                Session::flash('Failure','Une erreur est survenue');
            }
        }
        return redirect()->back();
    }

    public function BlockUserAccount(BlockingRequest $request){
        if ($request->validated()){
            $User = User::find($request->only('user')['user']);
            if (!$User) {
                Session::flash('Failure', 'Cet utilisateur n\'existe pas');
                return redirect()->back();
            }
            if ($User->id == auth()->user()->id) {
                Session::flash('Failure', 'Vous ne pouvez pas bloquer votre compte');
                return redirect()->back();
            }
            if (env('APP_DEFAULT_ACCOUNT') == $User->id){
                Session::flash('Failure','Vous ne pouvez pas modifier le compte par défaut');
                return redirect()->back();
            }
            if (intval($request->only('block')['block']) == 1){
                try {
                    $User->update([
                        'killSession' => 1,
                        'accountValidity' => 0
                    ]);
                    Session::flash('Success','Compte bloqué');
                }catch (\Exception $e){
                    Session::flash('Failure','Une erreur est survenue');
                }
            }else {
                try {
                    $User->update([
                        'killSession' => 0,
                        'accountValidity' => 1
                    ]);
                    Session::flash('Success','Compte débloqué');
                }catch (\Exception $e){
                    Session::flash('Failure','Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
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
