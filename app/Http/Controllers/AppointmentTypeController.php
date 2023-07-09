<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppointmentTypeRequest;
use App\Models\AppointmentType;
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
                    $Curl = curl_init();
                    curl_setopt_array($Curl, [
                        CURLOPT_URL => "https://api-adresse.data.gouv.fr/search/?q=$LocationToSearch&type=housenumber&autocomplete=1",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_POSTFIELDS => "",
                    ]);
                    curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($Curl);
                    curl_close($Curl);
                    $Coords = array('lat' => 0, 'long' => 0);
                    if ($response) {
                        $response = json_decode($response);
                        $Coords = array(
                            'lat' =>  $response->features[0]->geometry->coordinates[1],
                            'long' => $response->features[0]->geometry->coordinates[0]
                        );
                    }
                    $Coords = json_encode($Coords);
                    AppointmentType::create(array_merge($request->only('name','description','location','street','streetNumber','zipCode'),array('active' => 1, 'jsonCoordinatesInformations' => $Coords)));
                    Session::flash('Success','Ajout réussi');
                }catch (\Exception $e){
                    Session::flash('Failure', 'Une erreur est survenue');
                }
            }
        }
        return redirect()->back();
    }

    public function ViewAppointmentType(int $AppointmentType){
        $AppointmentTypeSearch = AppointmentType::find($AppointmentType);
        if (!$AppointmentTypeSearch) {
            Session::flash('Failure', 'Ce type de rendez-vous n\'existe pas');
            return redirect()->back();
        }
        return view('admin.appointment.type.viewType', ['AppointmentType' => $AppointmentTypeSearch]);
    }
}
