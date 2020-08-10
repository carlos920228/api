<?php

namespace App;
use App\corporation;
use App\Tw_rol;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'password',
        'N_Activo',
        'tw_rol_id',
        'corporation_id',
        'D_UltimaSesion'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function corporation(){
      return $this->belongsTo(corporation::class);
    }
    public function Tw_rol(){
      return $this->belongsTo(Tw_rol::class);
    }
}
