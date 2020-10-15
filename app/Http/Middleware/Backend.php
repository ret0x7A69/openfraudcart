<?php

namespace App\Http\Middleware;

    use Auth;
    use Closure;
    use Route;

    class Backend
    {
        public function handle($request, Closure $next)
        {
            $currentAction = explode('@', Route::currentRouteAction())[1];

            if ($currentAction == 'showLoginPage') {
                if (Auth::user() && Auth::user()->hasPermission('access_backend')) {
                    return redirect()->route('backend-dashboard');
                } else {
                    return $next($request);
                }
            } elseif (Auth::user() && Auth::user()->hasPermission('access_backend')) {
                return $next($request);
            }

            return redirect()->route('backend-logout');
        }
    }
