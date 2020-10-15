<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;

    class LoginController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
        }

        public function login()
        {
        }

        public function showLoginPage()
        {
            return redirect()->route('login');
        }
    }
