<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        if (!Session::has('user')) {
            $userPermission = null;
        } else {
            $userPermission = Session::get('user')['permission'];
        }

        if (in_array($userPermission, $permissions)) {
            return $next($request);
        } else {
            return redirect('login_page');
        }

        // if (!Session::has('user') || Session::get('user')['permission'] !== $permission) {
        //     return redirect('login_page');
        // }

        // if (auth()->check()) {
        //     foreach ($excludedPermissions as $permission) {
        //         if (auth()->user()->hasPermissionTo($permission)) {
        //             return redirect('login_page');
        //         }
        //     }
        // }
    }
}
