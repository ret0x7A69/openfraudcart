<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Http\Request;

    class DesignController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_design');
        }

        public function page(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if ($request->get('custom_css')) {
                    Setting::set('theme.custom.css', $request->input('custom_css'));
                }

                Setting::set('theme.logo', $request->input('logo') ?? '');
                Setting::set('theme.favicon', $request->input('favicon') ?? '');
                Setting::set('theme.background', $request->input('background') ?? '');

                $pattern = $request->input('pattern') ?? '';
                $pattern = str_replace('#', '', $pattern);

                Setting::set('theme.color.enable', strlen($pattern) > 0 ? 1 : 0);

                Setting::set('theme.color1', $pattern ?? '');
                Setting::set('theme.color2', $pattern ?? '');
                Setting::set('theme.color3', $pattern ?? '');
                Setting::set('theme.color4', $pattern ?? '');
                Setting::set('theme.color5', $pattern ?? '');
                Setting::set('theme.color6', $pattern ?? '');
                Setting::set('theme.color7', $pattern ?? '');
                Setting::set('theme.color8', $pattern ?? '');
                Setting::set('theme.color9', $pattern ?? '');

                return redirect()->route('backend-design')->with([
                    'successMessage' => __('backend/main.changes_successfully'),
                ]);
            }

            return view('backend.design.design');
        }
    }
