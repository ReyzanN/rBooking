<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class LocationAPI extends Model
{
    use ToolBox;

    public static function GetJsonLocation($LocationToSearch): bool|string
    {
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
        return json_encode($Coords);
    }
}
