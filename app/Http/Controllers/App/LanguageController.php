<?php

namespace App\Http\Controllers\App;

    use App;
    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Support\Facades\Auth;
    use Session;

    class LanguageController extends Controller
    {
        public function setLanguage($locale)
        {
            $locale = strtolower($locale);

            if (file_exists(resource_path('lang/'.$locale))) {
                if (Auth::check()) {
                    Auth::user()->language = $locale;
                    Auth::user()->save();
                } else {
                    Session::put('locale', $locale);
                }

                App::setLocale($locale);
            }

            return redirect()->back();
        }
    }
