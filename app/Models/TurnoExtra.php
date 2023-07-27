<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnoExtra extends Model
{
    use HasFactory;
    protected $table = 'turno_extra';

    protected $fillable = [
        'cantidad_horas', 'id_user'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
