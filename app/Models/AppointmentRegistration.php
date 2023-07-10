<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRegistration extends Model
{
    use HasFactory, ToolBox;

    protected $table = "appointment_registration";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idAppointment',
        'idUser',
        'confirmed',
        'confirmed_at',
        'confirmToken',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'confirmToken'
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
    public function GetAppointment()
    {
        return $this->hasOne(Appointment::class,'id','idAppointment')->get()->first();
    }

    public function GetUser()
    {
        return $this->hasOne(User::class, 'id','idUser')->get()->first();
    }

    /*
     * Functions
     */

    /**
     * @usage Check If user can register
     * @param User $user
     * @return bool
     */
    public static function AppointmentRegistrationAlreadyExistForUser($IdAppointment,$IdUser): bool{
        $Count = count(AppointmentRegistration::where(['idUser' => $IdUser,'idAppointment' => $IdAppointment])->get());
        if ($Count > 0){
            return true;
        }
        return false;
    }
}
