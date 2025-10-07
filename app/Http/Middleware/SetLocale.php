<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar se há um parâmetro de idioma na URL
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            if (in_array($locale, ['pt', 'en'])) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        // Verificar se há um idioma salvo na sessão
        elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        // Verificar o idioma do navegador
        else {
            $browserLocale = $request->getPreferredLanguage(['pt', 'en']);
            if ($browserLocale) {
                App::setLocale($browserLocale);
            }
        }

        return $next($request);
    }
}