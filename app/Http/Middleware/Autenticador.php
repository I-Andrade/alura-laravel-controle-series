<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/entrar');
        };

        //Se usar proteção em toda aplicação, excepcionar para rotas de login e registro
//        if (   !$request->is('entrar', 'registrar')
//            && !Auth::check()
//        ) {
//            return redirect('/entrar');
//        }

        return $next($request);
    }
}
