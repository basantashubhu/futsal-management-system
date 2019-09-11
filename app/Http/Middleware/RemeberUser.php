<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RememberUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::viaRemember()) {
            return redirect('/');
        }
        else
        {
            return redirect('/login');
        }
        return $next($request);
    }
}