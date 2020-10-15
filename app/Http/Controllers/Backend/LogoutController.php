<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class LogoutController extends Controller
    {
        public function logout()
        {
            Auth::logout();

            return redirect()->route('backend-login');
        }
    }
