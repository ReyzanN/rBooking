<?php

namespace App\Http\Controllers;

use App\Models\PasswordRecoverie;
use App\Models\PasswordRecovery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PasswordRecoveriesController extends Controller
{

    public function RedeemPassword(){
        return view('authentication.redeempassword');
    }

    public function RedeemPasswordConfirm(Request $request){
        Session::flash('Success', 'Si votre adresse email existe un lien vous à été envoyé !');
        $User = User::where(['email' => $request->only('email')])->first();
        if($User){
            $PasswordRecoveryToken = PasswordRecoverie::where(['email' => $User->email])->first();
            if ($PasswordRecoveryToken){
                $PasswordRecoveryToken->delete();
            }
            $PasswordRecoveryTool = new PasswordRecoverie();
            $Token = $PasswordRecoveryTool->TokenForPassword($User);
            $PasswordRecoveryTool->sendRecoveryEmail($User,$Token);
        }
        return redirect()->route('password.redeem');
    }

    public function RedeemPasswordForToken($Token){
        $Token = PasswordRecoverie::where(['token' => $Token])->first();
        if (!$Token || !$Token->TokenValidity()){
            Session::flash('Failure', 'Ce code n\'est plus valide, merci de le re-générer');
            return redirect()->route('auth.redeemPassword');
        }
        return view('authentication.resetPassword', ['token' => $Token]);
    }

    public function RedeemPasswordForTokenConfirm(Request $request){
        if ($request->validate(['_tokenPass' => 'required', 'password' => 'required'])){
            $PasswordRecoveryTool = PasswordRecoverie::where(['token' => $request->only('_tokenPass')])->first();
            $User = User::find($PasswordRecoveryTool->userAccount);
            $Password = $request->only('password');
            $User->update(['password' => bcrypt($Password['password'])]);
            $PasswordRecoveryTool->delete();
            Session::flash('Success', 'Mot de passe modifié avec succès');
            return redirect()->route('auth.login');
        }
    }
}
