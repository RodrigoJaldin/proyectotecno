<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    public function index()
    {
        // Obtener el contador de visitas con el atributo "pagina" igual a "user"
        $contadorVisitas = Visita::where('pagina', 'user')->count();

        return view('user.index', compact('contadorVisitas'));
    }
}
