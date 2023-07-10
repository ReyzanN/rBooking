<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AppointmentType extends Model
{
    use HasFactory, ToolBox;

    protected $table = "appointmenttype";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'location',
        'street',
        'streetNumber',
        'zipCode',
        'active',
        'jsonCoordinatesInformations'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    /*
     * References
     */
    public function GetAppointment(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(Appointment::class, 'idAppointmentType','id')->get();
    }

    /*
     * Functions
     */

    /**
     * @date 05/07/2023
     * @return string
     */
    public function GetStatusString(){
        if ($this->active) {
            return 'Actif';
        }
        return 'Non actif';
    }

    /**
     * @date 05/07/2023
     * @usage Get Active Type for Client display
     * @return mixed
     */
    public static function GetActive(){
        return AppointmentType::where(['active' => 1])->get();
    }

    /**
     * @date 10/07/2023
     * @usage Get Available appointment for display
     * @return collection
     */
    public function GetAvailableAppointment(): collection
    {
        return Appointment::where(['idAppointmentType' => $this->id, 'complete' => 0])->get();
    }

    /**
     * @date 10/07/2023
     * @usage Get Non Available appointment for display
     * @return collection
     */
    public function GetNonAvailableAppointment(){
        return Appointment::where(['idAppointmentType' => $this->id, 'complete' => 1])->get();
    }

    public function delete(): ?bool
    {
        $Appointment = $this->GetAppointment();
        foreach ($Appointment as $A){
            $A->delete();
        }
        return parent::delete();
    }




}
