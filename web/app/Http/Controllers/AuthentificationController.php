<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Mail\ConfirmAccountMail;
use App\Mail\ConfirmationForceRegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthentificationController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()) { redirect()->route('customer.dashboard'); }
        return view('authentication.index');
    }

    public function Register(RegistrationRequest $request): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        if ($request->validated()){
            $UserInfo = $request->only('name','surname','email','phone');
            $UserPass = $request->only('password');
            try {
                $User = User::create([
                    'name' => $UserInfo['name'],
                    'surname' => $UserInfo['surname'],
                    'email' => $UserInfo['email'],
                    'password' => bcrypt($UserPass['password']),
                    'phone' => $UserInfo['phone'],
                    'rank' => 0,
                    'accountValidity' => 0,
                    'confirmToken' => (new \App\Models\User)->GetTokenForAccount(20)
                ]);
                Mail::to($User)->send(new ConfirmAccountMail($User));
                Session::flash('Success', 'Création de compte réussie, merci de suivre les instructions reçus par mail');
                return view('authentication.landing');
            }catch (\Exception $e){
                if ($e->getCode() === "23000"){
                    Session::flash('Failure', 'Cet email est déjà utilisé');
                }else {
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
    }

    public function ConfirmAccount($Token){
        $User = User::where(['confirmToken' => $Token])->first();
        if ($User){
            if ($User->validate()){
                Session::flash('Success','Compte validé');
                return redirect()->route('auth.login');
            }else{
                Session::flash('Failure', 'Une erreur est survenue');
                return redirect()->route('auth.login');
            }
        }
        return redirect()->route('auth.login');
    }

    public function Login(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()) { return redirect()->route('customer.dashboard'); }
        return view('authentication.login');
    }

    public function LoginAttempt(LoginRequest $request){
        if ($request->validated()){
            $Credentials = array_merge($request->only('email','password'),array('accountValidity' => 1));
            if (auth()->attempt($Credentials)){
                auth()->user()->UpdateLastConnection();
                return redirect()->route('customer.dashboard');
            }
            Session::flash('Failure','Combinaison mot de passe / email inconnue | Ou Votre compte est bloqué contactez votre administrateur');
            return redirect()->back();
        }
    }

    public function LogOut(): \Illuminate\Http\RedirectResponse
    {
        if (auth()->user()){
            auth()->logout();
        }
        return redirect()->route('auth.login');
    }
}
