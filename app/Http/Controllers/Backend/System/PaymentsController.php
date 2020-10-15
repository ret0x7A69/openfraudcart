<?php

namespace App\Http\Controllers\Backend\System;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Http\Request;
    use Validator;

    class PaymentsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:system_payments');
        }

        public function showPayments(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'payments_bitcoin_api' => 'required|string|max:250',
                ]);

                if (! $validator->fails()) {
                    Setting::set('bitcoin.api', encrypt($request->input('payments_bitcoin_api')));

                    return redirect()->route('backend-system-payments')->with([
                        'successMessage' => __('backend/main.changes_successfully'),
                    ]);
                } else {
                    $request->flash();

                    return redirect()->route('backend-system-payments')->withErrors($validator)->withInput();
                }
            }

            return view('backend.system.payments');
        }
    }
