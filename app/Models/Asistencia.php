<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';
    protected $fillable = [
        'fecha',
        'hora_llegada',
        'hora_salida',
        'id_user'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
