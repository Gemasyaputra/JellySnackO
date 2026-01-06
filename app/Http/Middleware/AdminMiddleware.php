<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next)
{
    // Gunakan $request->user()
    // Ini lebih disukai di dalam middleware setelah middleware 'auth' dijalankan
    if ($request->user() && $request->user()->role == 'admin') {
        return $next($request);
    }

    return redirect('/');
}
}
