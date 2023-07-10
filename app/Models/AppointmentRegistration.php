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
        'confirmed_at'
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
    public function GetAppointment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Appointment::class,'id','idAppointment');
    }

    public function GetUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id','idUser');
    }

    /*
     * Functions
     */
}
