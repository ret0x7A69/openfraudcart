<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;

    class DashboardController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
        }

        public function showDashboard()
        {
            return view('backend.dashboard');
        }
    }
