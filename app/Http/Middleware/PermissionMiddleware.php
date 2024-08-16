<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
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
        // Periksa apakah session 'user' dan 'permission' ada dan bernilai true
        if (!Session::has('user') || !Session::get('user')['permission']) {
            // Jika tidak, redirect ke halaman login
            return redirect('login_page');
        }

        // Jika permission bernilai true, lanjutkan request
        return $next($request);
    }
}
