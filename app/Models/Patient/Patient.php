<?php

namespace App\Models\Patient;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Device\UserDevice;
use Illuminate\Contracts\Auth\CanResetPassword;

class Patient extends Model implements CanResetPassword
{
    use Notifiable, HasApiTokens;

    protected $guard = 'patient';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat'
    ];

    /**
     * * Patient has one device
     */
    public function userDevice()
    {
        return $this->hasOne(UserDevice::class);
    }
}
