<?php

namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Mails\AccountCreatedMail;
    use App\Models\Notification;
    use App\Models\User;
    use Illuminate\Foundation\Auth\RegistersUsers;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Mail;

    class RegisterController extends Controller
    {
        use RegistersUsers;

        protected $redirectTo = '/home';

        public function __construct()
        {
            $this->middleware('guest');
        }

        protected function validator(array $data)
        {
            return Validator::make($data, [
                /*
                'name' => [
                    'required', 'string', 'min:3', 'max:30'
                ],
                */
                'username' => [
                    'required', 'string', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9_]+$/u', 'unique:users',
                ],
                /*
                'email' => [
                    'required', 'string', 'email', 'max:255', 'unique:users'
                ],
                */
                'jabber_id' => [
                    'required', 'string', 'email', 'max:255', 'unique:users',
                ],
                'password' => [
                    'required', 'string', 'min:6', 'max:100', 'confirmed',
                ],
                'captcha' => 'required|captcha',
            ]);
        }

        protected function create(array $data)
        {
            $user = User::create([
                'name'                  => '', //$data['name'],
                'username'              => $data['username'],
                //'email'                 => $data['email'],
                'jabber_id'             => $data['jabber_id'],
                'newsletter_enabled'    => isset($data['newsletter_enabled']) ? 1 : 0,
                'balance_in_cent'       => 0,
                'password'              => Hash::make($data['password']),
            ]);

            if ($user) {
                //Mail::to($data['email'])->send(new AccountCreatedMail($user));
                Notification::create([
                    'custom_id' => $user->id,
                    'type' => 'user',
                ]);

                return $user;
            }
        }

        public function showRegistrationForm()
        {
            return view('frontend.auth.register');
        }
    }
