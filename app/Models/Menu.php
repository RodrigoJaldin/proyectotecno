<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = ['nombre', 'url', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
