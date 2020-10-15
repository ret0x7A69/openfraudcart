<?php

namespace App\Http\Controllers\Custom;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Symfony\Component\HttpFoundation\Response;

    class CSSController extends Controller
    {
        public function __construct()
        {
        }

        public function generateOverridingColorsCSS()
        {
            return response()
            ->view('custom/css', [
                'color1' => Setting::get('theme.color1'),
                'color2' => Setting::get('theme.color2'),
                'color3' => Setting::get('theme.color3'),
                'color4' => Setting::get('theme.color4'),
                'color5' => Setting::get('theme.color5'),
                'color6' => Setting::get('theme.color6'),
                'color7' => Setting::get('theme.color7'),
                'color8' => Setting::get('theme.color8'),
                'color9' => Setting::get('theme.color9'),
            ], 200)
            ->header('Content-Type', 'text/css');
        }

        public function generateCustomCSS()
        {
            return response(Setting::get('theme.custom.css', ''))
            ->header('Content-Type', 'text/css');
        }
    }
