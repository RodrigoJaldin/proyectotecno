<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contrato';
    protected $fillable = [
        'id_user',
        'horas_laborales',
        'fecha_inicio',
        'fecha_fin',
        'sueldo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
