<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomersPasswordUpdateRequest;
use App\Http\Requests\CustomersPersonalInformationsUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function AccountSettingsView(){
        return view('customers.settings.index');
    }

    public function UpdateAccountInformation(CustomersPersonalInformationsUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->validated()){
            $UserInformation = $request->only('name','surname','email','phone');
            try {
                auth()->user()->update([
                    'name' => $UserInformation['name'],
                    'surname' => $UserInformation['surname'],
                    'email' => $UserInformation['email'],
                    'phone' => $UserInformation['phone']
                ]);
                Session::flash('Success','Modification réalisée avec succès');
            }catch (\Exception $e){
                Session::flash('Failure','Une erreur est survenue');
            }
        }
        return redirect()->back();
    }

    public function UpdatePasswordAccount(CustomersPasswordUpdateRequest $request){
        if ($request->validated()){
            $NewPassword = $request->only('password');
            $NewPasswordConfirm = $request->only('password_confirm');
            if ($NewPassword['password'] === $NewPasswordConfirm['password_confirm']){
                try {
                    auth()->user()->update([
                        'password' => bcrypt($NewPassword['password'])
                    ]);
                    Session::flash('Success', 'Modification réalisé avec succès, merci de vous reconnecter');
                    auth()->logout();
                    return \redirect()->route('auth.login');
                }catch (\Exception $e){
                    Session::flash('Failure','Une erreur est survenue');
                }
            }else {
                Session::flash('Failure','Les deux mots de passe ne correspondent pas');
            }
            return redirect()->back();
        }
    }
}
