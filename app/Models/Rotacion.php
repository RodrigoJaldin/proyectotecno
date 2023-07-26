<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotacion extends Model
{
    use HasFactory;
    protected $table = 'rotacion';
    protected $fillable = [
        'fecha',
        'usuario_solicitante_id',
        'usuario_reemplazante_id',
        'id_horario',
    ];

    // Relación con el usuario solicitante
    public function usuarioSolicitante()
    {
        return $this->belongsTo(User::class, 'usuario_solicitante_id');
    }

    // Relación con el usuario reemplazante
    public function usuarioReemplazante()
    {
        return $this->belongsTo(User::class, 'usuario_reemplazante_id');
    }

    // Relación con el horario involucrado en la rotación
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }
}
