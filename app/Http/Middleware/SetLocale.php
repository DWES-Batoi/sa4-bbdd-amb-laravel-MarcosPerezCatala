<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Llegim l'idioma de la sessió, si no existeix, agafem el de config
        $locale = Session::get('locale', config('app.locale'));
        
        // Apliquem l'idioma a l'aplicació
        App::setLocale($locale);

        return $next($request);
    }
}