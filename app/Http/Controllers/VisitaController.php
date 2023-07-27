<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VisitaController extends Controller
{
    public function index()
    {
        $contadorVisitas = Visita::where('pagina', 'user')->count();

        return view('user.index', compact('contadorVisitas'));
    }

    public function generarGrafico()
    {
        $visitasPorPagina = Visita::groupBy('pagina')
            ->select('pagina', DB::raw('count(*) as total'))
            ->get();
        $paginas = $visitasPorPagina->pluck('pagina');
        $cantidadVisitas = $visitasPorPagina->pluck('total');
        return view('grafico.graficovisita', compact('paginas', 'cantidadVisitas'));
    }
}
