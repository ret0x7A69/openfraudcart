<?php

namespace App\Http\Middleware;

    use Auth;
    use Closure;

    class Permission
    {
        public function handle($request, Closure $next, $permission)
        {
            if (Auth::user() && (Auth::user()->hasPermission($permission))) {
                return $next($request);
            }

            return redirect()->route('no-permissions');
        }
    }
