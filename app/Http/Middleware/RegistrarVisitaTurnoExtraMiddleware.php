<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visita;
use Illuminate\Support\Facades\Session;

class RegistrarVisitaTurnoExtraMiddleware
{
    public function handle($request, Closure $next)
    { 
        $clientIp = $request->getClientIp(true);

        
        // Crear la nueva visita en la tabla "visita"
        $visita = new Visita();
        $visita->fecha = date('Y-m-d');
        $visita->ip = $clientIp;
        $visita->pagina = 'turnos_extra';
        $visita->url = $request->fullUrl();
        $visita->save();

        // Contar las visitas a la página "user" y guardar el valor en la sesión
        $contadorVisitas = Visita::where('pagina', 'turnos_extra')->count();
        Session::put('contadorVisitasTurno', $contadorVisitas);

        
        return $next($request);
    }
}
