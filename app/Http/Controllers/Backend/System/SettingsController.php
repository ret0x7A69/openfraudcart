<?php

namespace App\Http\Controllers\Backend\System;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use App\Rules\RuleFAQExists;
    use Illuminate\Http\Request;
    use Validator;

    class SettingsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:system_settings');
        }

        public function showSettings(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'settings_app_name' => 'required|string|max:50',
                    'settings_shop_currency' => 'required|string|max:4',
                    'settings_replace_entry' => new RuleFAQExists(),
                    'settings_access_only_for_users' => 'required|integer',
                    'settings_bonus_percent' => 'required|string',
                    'app_locale' => 'required|string',
                    'available_locales' => 'required|string',
                    'register_newsletter_checked' => 'required|integer',
                    'settings_api_enabled' => 'required|integer',
                    'settings_api_key' => 'string|max:250',
                    'creditcards_enabled' => 'required|integer',
                ]);

                if (! $validator->fails()) {
                    Setting::set('app.name', $request->input('settings_app_name'));
                    Setting::set('shop.currency', strtoupper($request->input('settings_shop_currency')));
                    Setting::set('shop.replace_rules', $request->input('settings_replace_entry'));
                    Setting::set('app.access_only_for_users', $request->input('settings_access_only_for_users'));
                    Setting::set('register.newsletter_enabled', $request->input('register_newsletter_checked'));
                    Setting::set('api.enabled', $request->input('settings_api_enabled'));
                    Setting::set('api.key', $request->get('settings_api_key') ? encrypt($request->input('settings_api_key')) : '');
                    Setting::set('shop.creditcards.enabled', $request->input('creditcards_enabled'));
                    Setting::set('shop.bonus_in_percent', $request->input('settings_bonus_percent'));
                    Setting::set('app.available.locales', $request->input('available_locales'));

                    $locale = strtolower($request->input('app_locale'));
                    if (in_array($locale, Setting::getAvailableLocales())) {
                        Setting::set('app.locale', $locale);
                    }

                    return redirect()->route('backend-system-settings')->with([
                        'successMessage' => __('backend/main.changes_successfully'),
                    ]);
                } else {
                    $request->flash();

                    return redirect()->route('backend-system-settings')->withErrors($validator)->withInput();
                }
            }

            return view('backend.system.settings');
        }
    }
