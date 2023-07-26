<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GerenteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario logueado tiene el rol de "Gerente"
        if (auth()->user()->rol->tipo_rol === 'Gerente') {
            return $next($request);
        }

        // Si el usuario no es gerente, redireccionar al dashboard
        return redirect()->route('dashboard')->with('error', 'Acceso no autorizado.');
    }
}
