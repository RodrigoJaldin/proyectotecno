<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $table = 'documento';
    protected $fillable = [
        'descripcion',
        'tipo_documento',
        'archivo',
        'id_user'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
