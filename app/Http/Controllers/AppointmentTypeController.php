<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentTypeRequest;
use App\Http\Requests\UpdateAppointmentTypeRequest;
use App\Models\AppointmentType;
use App\Models\LocationAPI;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AppointmentTypeController extends Controller
{
    public function __construct(){
        $this->middleware(['AdministrationMember']);
    }

    public function __invoke(){
        $Appointment = AppointmentType::all();
        $AppointmentActive = AppointmentType::where(['active' => 1])->get();
        $AppointmentCount = count($Appointment);
        $AppointmentCountActive = count($AppointmentActive);
        return view('admin.appointment.type.index', ['AppointmentType' => $Appointment, 'AppointmentTypeCount' => $AppointmentCount,'AppointmentTypeCountActive' => $AppointmentCountActive]);
    }

    public function AddAppointmentType(AddAppointmentTypeRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                try {
                    $LocationToSearch = $request->only('streetNumber')['streetNumber'].' '.$request->only('street')['street'].' '.$request->only('zipCode')['zipCode'].' '.$request->only('location')['location'];
                    $LocationToSearch = urlencode($LocationToSearch);
                    AppointmentType::create(array_merge($request->only('name','description','location','street','streetNumber','zipCode'),array('active' => 1, 'jsonCoordinatesInformations' => LocationAPI::GetJsonLocation($LocationToSearch))));
                    Session::flash('Success','Ajout réussi');
                }catch (\Exception $e){
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
    }

    public function UpdateAppointmentType(UpdateAppointmentTypeRequest $request){
        if (Gate::allows('UserAdmin')){
            if ($request->validated()){
                $AppointmentType = AppointmentType::find($request->only(['id']))->first();
                if (!$AppointmentType) {
                    Session::flash('Failure','Ce type de rendez-vous n\'existe pas');
                    return redirect()->back();
                }
                try {
                    $LocationToSearch = $request->only('streetNumber')['streetNumber'].' '.$request->only('street')['street'].' '.$request->only('zipCode')['zipCode'].' '.$request->only('location')['location'];
                    $LocationToSearch = urlencode($LocationToSearch);
                    $AppointmentType->update(array_merge($request->only('name','description','location','street','streetNumber','zipCode','active'),array('jsonCoordinatesInformations' => LocationAPI::GetJsonLocation($LocationToSearch))));
                    Session::flash('Success','Modification réalisée avec succès');
                }catch (\Exception $e){
                    dd($e);
                    Session::flash('Failure','Une erreur est survenue');
                }
                return redirect()->back();
            }
        }
    }

    public function ViewAppointmentType(int $AppointmentType){
        $AppointmentTypeSearch = AppointmentType::find($AppointmentType);
        if (!$AppointmentTypeSearch) {
            Session::flash('Failure', 'Ce type de rendez-vous n\'existe pas');
            return redirect()->back();
        }
        $Users = User::GetActiveUser();
        return view('admin.appointment.type.viewType', ['AppointmentType' => $AppointmentTypeSearch, 'Users' => $Users]);
    }
}
