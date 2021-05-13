<?php

namespace App\Models\Patient;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Device\UserDevice;

class Patient extends Model
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
