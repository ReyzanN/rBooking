<?php

namespace App\Models;

use Cassandra\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory, ToolBox;

    protected $table = "appointment";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idAppointmentType',
        'date',
        'place',
        'complete',
        'active'
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
    public function GetAppointmentType()
    {
        return $this->hasOne(AppointmentType::class, 'id','idAppointmentType')->get()->first();
    }

    public function GetAppointmentRegistration(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(AppointmentRegistration::class,'idAppointment','id')->where('status', '<>','3')->get();
    }

    public function GetAppointmentRegistrationForDelete(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->hasMany(AppointmentRegistration::class,'idAppointment','id')->get();
    }

    public function GetPendingRegistrationForAppointment(): \Illuminate\Database\Eloquent\Collection
    {
         return $this->hasMany(AppointmentRegistration::class,'idAppointment','id')->where(['status' => 1])->get();
    }


    /*
     * Functions
     */

    /**
     * @date 10/07/2023
     * @usage Return count of remaining place for appointment
     * @return int
     */
    public function GetRemainingPlace(): int{
        return ($this->place - count(AppointmentRegistration::where(['idAppointment' => $this->id])->where('confirmed', '<>', '1')->where('status', '<>','3')->get()));
    }


    /**
     * @usage Update at full if no place left
     * @return void
     */
    public function UpdateRegistration(): void
    {
        $Registration = count($this->GetAppointmentRegistration());
        if ($Registration >= $this->place){
            $this->update(['complete' => 1,'place' => $Registration]);
        }else{
            $this->update(['complete' => 0]);
        }
    }

    /**
     * @usage Check if appointment is full before new registration
     * @return bool
     */
    public function IsFull(): bool
    {
        $Registration = count($this->GetAppointmentRegistration());
        if ($Registration >= $this->place){
            return true;
        }
        return false;
    }

    /**
     * @usage Delete method
     * @return bool|null
     */
    public function delete(){
        $Registration = $this->GetAppointmentRegistrationForDelete();
        foreach ($Registration as $Re){
            $Re->delete();
        }
        return parent::delete();
    }

    /**
     * @usage Get Count of registration for view
     * @return int
     */
    public function GetCountOfRegistration(): int{
        return count($this->GetAppointmentRegistration());
    }

    public static function GetAppointmentForDay(){
        $Date = new \DateTime();
        $AppointmentType = AppointmentType::all();
        foreach ($AppointmentType as $A){
            $A->AppointmentListComplete = Appointment::where(DB::raw('DATE(date)'), '=' ,$Date->format('Y-m-d'))->where(['idAppointmentType' => $A->id])->where(['complete' => 1])->get();
            $A->AppointmentListInComplete = Appointment::where(DB::raw('DATE(date)'), '=' ,$Date->format('Y-m-d'))->where(['idAppointmentType' => $A->id])->where(['complete' => 0])->get();
        }
        return $AppointmentType;
    }

    public function GetLocation(): string {
        $Type = $this->GetAppointmentType();
        return $Type->streetNumber.' '.$Type->street.' '.$Type->zipCode.' '.$Type->location;
    }
}
