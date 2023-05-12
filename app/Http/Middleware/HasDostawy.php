<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasDostawy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user->roles()->pluck('role_name')->contains('magazynier') ||
            $user->roles()->pluck('role_name')->contains('szef') ||
            $user->roles()->pluck('role_name')->contains('kierownik')) {
            return $next($request);
        }

        return redirect('/');
    }
}
