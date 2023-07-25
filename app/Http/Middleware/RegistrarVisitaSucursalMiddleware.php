<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visita;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrarVisitaSucursalMiddleware
{
    public function handle($request, Closure $next)
    { 
        $clientIp = $request->getClientIp(true);

        
        // Crear la nueva visita en la tabla "visita"
        $visita = new Visita();
        $visita->fecha = date('Y-m-d');
        $visita->ip = $clientIp;
        $visita->pagina = 'sucursal';
        $visita->url = $request->fullUrl();
        $visita->save();

        // Contar las visitas a la página "user" y guardar el valor en la sesión
        $contadorVisitas = Visita::where('pagina', 'sucursal')->count();
        Session::put('contadorVisitasSucursal', $contadorVisitas);

        
        return $next($request);
    }
}
