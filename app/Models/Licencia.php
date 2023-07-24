<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licencia extends Model
{
    use HasFactory;

    protected $table = 'licencia';
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'tipo_licencia',
        'id_user'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
