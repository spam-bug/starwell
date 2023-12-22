<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $fragments = explode('/', $request->getRequestUri());

        $page = $fragments[2] ?? 'dashboard';
        $route = "admin.{$page}";

        if (Auth::check()) {
            if (! Auth::user()->isAdmin()) {
                return redirect(route($route));
            }
        }

        return $next($request);
    }
}
