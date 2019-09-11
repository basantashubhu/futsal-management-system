<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessControl
{
    public function handle($request, Closure $next,$pageName,$permission)
    {
        if(!Auth::user()->checkPermission($pageName,$permission)) {
            return redirect('/notFound');
        }
        return $next($request);
    }
}