<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Config;
use Closure;
use Illuminate\Support\Facades\Session;
use App;

class setLang
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
        App::setLocale(Session::has('language') ? Session::get('language') : Config::get('app.locale'));

        return $next($request);
    }
}
