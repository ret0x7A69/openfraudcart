<?php

namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class RobotsController extends Controller
    {
        public function __construct()
        {
        }

        public function robots()
        {
            $robots = 'User-agent: *'.PHP_EOL
            .'Disallow:'.PHP_EOL.PHP_EOL;

            $robots .= 'Sitemap: '.route('sitemap-xml');

            return response($robots, 200)
                ->header('Content-Type', 'text/plain');
        }
    }
