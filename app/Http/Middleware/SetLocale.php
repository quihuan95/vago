<?php

namespace App\Http\Middleware;

use App\Support\Locale;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', Locale::VI);

        if (! in_array($locale, [Locale::VI, Locale::EN], true)) {
            $locale = Locale::VI;
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
