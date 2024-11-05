<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = app()->getLocale();

        if (in_array(@$request->segments()[0], config('app.locales'))) {
            $locale = $request->segments()[0];
        }

        App::setLocale($locale);

        return $next($request);
    }
}
