<?php

namespace App\Http\Middleware;

    use App;
    use Closure;
    use Illuminate\Support\Facades\Auth;
    use Session;

    class Language
    {
        public function handle($request, Closure $next)
        {
            if (Auth::check()) {
                if (file_exists(resource_path('lang/'.Auth::user()->language))) {
                    App::setLocale(Auth::user()->language);
                }
            } elseif (Session::get('locale')) {
                $locale = Session::get('locale');

                if (file_exists(resource_path('lang/'.$locale))) {
                    App::setLocale($locale);
                }
            }

            return $next($request);
        }
    }
