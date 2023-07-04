<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthentificationController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()) { redirect()->route('customer.dashboard'); }
        return view('authentication.index');
    }

    public function Register(RegistrationRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->validated()){
            $UserInfo = $request->only('name','surname','email','phone');
            $UserPass = $request->only('password');
            try {
                User::create([
                    'name' => $UserInfo['name'],
                    'surname' => $UserInfo['surname'],
                    'email' => $UserInfo['email'],
                    'password' => bcrypt($UserPass['password']),
                    'phone' => $UserInfo['phone'],
                    'rank' => 0,
                    'accountValidity' => 1,
                ]);
                Session::flash('Success', 'Création de compte réussie');
                return redirect()->route('auth.login');
            }catch (\Exception $e){
                Session::flash('Failure', 'Une erreur s\'est produite, merci de réessayer');
            }
        }
        return redirect()->back();
    }

    public function Login(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()) { return redirect()->route('app.guest'); }
        return view('authentication.login');
    }

    public function LoginAttempt(LoginRequest $request){
        if ($request->validated()){
            if (auth()->attempt($request->only('email','password'))){
                return redirect()->route('customer.dashboard');
            }
            Session::flash('Failure','Combinaison mot de passe / email inconnue');
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
