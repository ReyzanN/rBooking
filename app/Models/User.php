<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

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
     * Functions
     */

    /**
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
}
