<?php

namespace App\Models;

use App\Mail\PasswordRecoveieEmail;
use App\Mail\RemovedAppointmentMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class PasswordRecoverie extends Model
{
    use HasFactory;

    protected $table = "password_recoveries";

    protected $fillable = [
        'email',
        'userAccount',
        'token'
    ];

    public function sendRecoveryEmail(User $user,$Token){
        try {
            Mail::to($user)->send(new PasswordRecoveieEmail($Token,$user->email,$user->name));
        }catch (\Exception $e){
            dd($e);
            // Silence is...
        }
    }

    public function TokenForPassword(User $user){
        $Token = Str::random(20);
        PasswordRecoverie::create(array(
            'email' => $user->email,
            'userAccount' => $user->id,
            'token' => $Token
        ));
        return $Token;
    }

    public function TokenValidity() :bool {
        $Date = new \DateTime('now');
        $this->created_at = new \DateTime($this->created_at);
        $this->created_at = $this->created_at->add(new \DateInterval('PT2H'));
        if ($Date >= $this->created_at){
            return false;
        }
        return true;
    }
}
