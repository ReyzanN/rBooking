<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, ToolBox;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'rank',
        'accountValidity',
        'accountVerifiedAt',
        'lastConnection',
        'killSession',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed'
    ];

    /*
     * References
     */

    public function GetAppointmentRegistrationOfDay(){
        return $this->hasMany(AppointmentRegistration::class,'idUser','id')->whereRaw('appointment_registration.idAppointment IN (SELECT appointment.id FROM appointment WHERE DATE(appointment.date) = DATE(NOW()))')->get();
    }

    /*
     * Rank Check Functions
     */

    /**
     * @date 05/07/2023
     * @name IsConsultant
     * @return bool
     */
    public function IsConsultant(): bool{
        if ($this->rank >= 1){ return true; }
        return false;
    }

    /**
     * @date 05/07/2023
     * @name IsAdmin
     * @return bool
     */
    public function IsAdmin(): bool {
        if ($this->rank >= 2) { return true; }
        return false;
    }

    /**
     * @date 05/07/2023
     * @name IsSuperAdmin
     * @return bool
     */
    public function IsSuperAdmin(): bool {
        if ($this->rank == 3){
            return true;
        }
        return false;
    }

    /*
     * Functions
     */

    /**
     * @date 04/07/2023
     * @name UpdateLastConnection
     * @usage Update the last connection timestamp for user
     * @return bool
     */
    public function UpdateLastConnection() : bool{
        try {
            $this->update(['lastConnection' => new \DateTime()]);
            return true;
        }catch (\Exception $e){
            // Silence is golden
        }
        return false;
    }

    /**
     * @date 04/07/2023
     * @name GetRankString
     * @usage Get user rank's string
     * @return string
     */
    public function GetRankString(): string
    {
        return match ($this->rank) {
            0 => "Client",
            1 => "Consultant",
            2 => "Admin",
            3 => "Super-Admin",
            default => "Inconnu",
        };
    }

    /**
     * @date 05/07/2023
     * @usage Determine if user has right
     * @name HasRank
     * @return bool
     */
    public function HasRank(): bool{
        if ($this->rank > 0) { return true; }
        return false;
    }

    /**
     * @date 05/07/2023
     * @name GetValidityString
     * @return string
     */
    public function GetValidityString(): string {
        if ($this->accountValidity == 1) { return "Compte Valide"; }
        return "Compte non valide";
    }

    /**
     * @usage Get List of active Users
     * @return Collection
     */
    public static function GetActiveUser(): Collection
    {
        return User::where(['accountValidity' => 1])->orderBy('surname', 'asc')->get();
    }
}
