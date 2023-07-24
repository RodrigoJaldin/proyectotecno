<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horario';
    protected $fillable = [
        'turno',
        'hora_entrada',
        'hora_salida'
    ];

    public function user_horario()
    {
        return $this->belongsToMany(HorarioUser::class, 'id_horario');
    }
}
