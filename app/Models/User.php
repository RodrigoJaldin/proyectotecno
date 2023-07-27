<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';
    protected $fillable = [
        'name',
        'apellido',
        'ci',
        'telefono',
        'codigo_empleado',
        'foto_user',
        'email',
        'password',
        'id_sucursal',
        'id_rol'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'id_user');
    }

    public function licencia()
    {
        return $this->hasMany(Licencia::class, 'id_user');
    }

    public function documento()
    {
        return $this->hasMany(Documento::class, 'id_user');
    }

    public function user_horarios()
    {
        return $this->belongsToMany(HorarioUser::class, 'user_horario', 'id_user', 'id_horario');
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'user_horario', 'id_user', 'id_horario');
    }


     // Relación con las rotaciones que ha solicitado el usuario
     public function rotacionesSolicitadas()
     {
         return $this->hasMany(Rotacion::class, 'usuario_solicitante_id');
     }

     // Relación con las rotaciones en las que actúa como reemplazante
     public function rotacionesReemplazante()
     {
         return $this->hasMany(Rotacion::class, 'usuario_reemplazante_id');
     }

     public function contrato()
     {
         return $this->hasOne(Contrato::class, 'id_user');
     }

    public function turno_extra()
    {
        return $this->hasMany(TurnoExtra::class, 'id_user');
    }
}
