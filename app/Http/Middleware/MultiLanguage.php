<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;

class MultiLanguage
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
        if ($language = Session::get('lang')) {
            App::setLocale($language);
        }

        return $next($request);
    }
}
