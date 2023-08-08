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
        'usuario_reemplazante_id'
    ];

    public function userHorarios_solicitante()
    {
        return $this->belongsTo(HorarioUser::class, 'usuario_solicitante_id');
    }

    public function userHorarios_reemplazante()
    {
        return $this->belongsTo(HorarioUser::class, 'usuario_reemplazante_id');
    }


}
