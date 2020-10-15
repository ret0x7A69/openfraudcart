<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use App\Models\User;
    use Auth;
    use Fabiang\Xmpp\Client;
    use Fabiang\Xmpp\Options;
    use Fabiang\Xmpp\Protocol\Message;
    use Illuminate\Http\Request;
    use Validator;

    class JabberController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:jabber_newsletter');
        }

        public function loginSave(Request $request)
        {
            if (Auth::user()->hasPermission('jabber_login') && $request->getMethod() == 'POST') {
                $address = $request->input('jabber_address') ?? '';
                $username = $request->input('jabber_username') ?? '';
                $password = $request->input('jabber_password') ?? '';

                Setting::set('jabber.address', $address);
                Setting::set('jabber.username', $username);
                Setting::set('jabber.password', $password);

                return redirect()->route('backend-jabber')->with([
                    'successMessage' => __('backend/jabber.login.successfully'),
                ]);
            }

            return redirect()->route('backend-jabber');
        }

        public function sendNewsletter(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'jabber_message' => 'required|max:2000',
                ]);

                if (! $validator->fails()) {
                    $input = $request->input('jabber_message');

                    $options = new Options(Setting::get('jabber.address'));
                    $options->setUsername(Setting::get('jabber.username'))->setPassword(Setting::get('jabber.password'));

                    $client = new Client($options);

                    $error = false;
                    try {
                        $client->connect();
                    } catch (\Exception $ex) {
                        $error = true;
                    }

                    if ($client->getConnection() != null && $client->getConnection()->isConnected() && ! $error) {
                        foreach (User::all() as $user) {
                            if (! $user->enabledNewsletter()) {
                                continue;
                            }

                            $message = new Message();
                            $message->setMessage($input)->setTo($user->jabber_id);
                            $client->send($message);
                        }

                        return redirect()->route('backend-jabber')->with([
                            'successMessage' => __('backend/jabber.newsletter.successfully'),
                        ]);
                    } else {
                        return redirect()->route('backend-jabber')->with([
                            'errorMessage' => __('backend/jabber.newsletter.error_connection'),
                        ])->withErrors($validator)->withInput();
                    }
                }

                $request->flash();

                return redirect()->route('backend-jabber')->withErrors($validator)->withInput();
            }

            //return redirect()->route('backend-jabber');
        }

        public function showJabberPage()
        {
            return view('backend.jabber');
        }
    }
