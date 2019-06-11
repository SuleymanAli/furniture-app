<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        // If Not User Cannot Access Current Area
        if ($request->user() === null) {
            return back()->withMessage('You Need Login');
        }
        
        // If User Has Any Role OR Don`t Use Role Middleware Go Ahead
        if ($request->user()->hasAnyRole($role) || !$role) {
            return $next($request);
        }

        return back()->withMessage('Insufficient permissions');
    }
}
