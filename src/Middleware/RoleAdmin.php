<?php

namespace  Lilian\PluginCmsLaravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role->id == 1) {
            return $next($request);
        }
        return redirect()->route('plugincmslaravel::admin.index')->withErrors('Vous n\'êtes pas autorisé à accéder à cette section.');;
    }
}
