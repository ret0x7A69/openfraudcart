<?php

namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;
    use Illuminate\Http\Request;

    class LoginController extends Controller
    {
        use AuthenticatesUsers;

        protected $redirectTo = '/home';

        protected $username = 'username';

        public function __construct()
        {
            $this->middleware('guest')->except('logout');
        }

        protected function credentials(Request $request)
        {
            $field = $this->field($request);

            return [
                $field => $request->get($this->username()),
                'password' => $request->get('password'),
            ];
        }

        public function field(Request $request)
        {
            $email = $this->username();

            return 'username';
            //return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
        }

        protected function validateLogin(Request $request)
        {
            $field = $this->field($request);

            $messages = [
                "{$this->username()}.exists" => __('auth.not_exists'),
                'captcha' => __('frontend/main.captcha_failed'),
            ];

            $this->validate($request, [
                $this->username() => "required|exists:users,{$field}",
                'password' => 'required',
                'captcha' => 'required|captcha',
            ], $messages);
        }

        public function showLoginForm()
        {
            return view('frontend.auth.login');
        }
    }
