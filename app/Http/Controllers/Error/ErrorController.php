<?php

namespace App\Http\Controllers\Error;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class ErrorController extends Controller
    {
        public function forbidden()
        {
            return view('errors.403');
        }

        public function notFound()
        {
            return view('errors.404');
        }

        public function fatal()
        {
            return view('errors.500');
        }

        public function serviceUnavailable()
        {
            return view('errors.503');
        }

        public function noPermissions()
        {
            return view('errors.no_permissions');
        }
    }
