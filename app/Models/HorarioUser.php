<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioUser extends Model
{
    use HasFactory;

    protected $table = 'user_horario';
    protected $fillable = [
        'dia_laboral',
        'id_user',
        'id_horario'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    public function rotacion_solicitante()
    {
        return $this->hasMany(Rotacion::class, 'usuario_solicitante_id');
    }

    public function rotacion_reemplazante()
    {
        return $this->hasMany(Rotacion::class, 'usuario_reemplazante_id');
    }
}
