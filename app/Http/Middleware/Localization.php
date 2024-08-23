<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = ($request->hasHeader('Accept-Language')) ? $request->header('Accept-Language') : 'en';

        // check the languages defined is supported
        if (!in_array($locale, app()->config->get('app.supported_languages'))) {
            $locale = 'en';
        }

        // set the local language
        app()->setLocale($locale);

        // continue request
        return $next($request);
    }
}
