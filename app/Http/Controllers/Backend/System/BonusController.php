<?php

namespace App\Http\Controllers\Backend\System;

    use App\Http\Controllers\Controller;
    use App\Models\Bonus;
    use Illuminate\Http\Request;
    use Validator;

    class BonusController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:system_bonus');
        }

        public function delete($id)
        {
            $bonus = Bonus::where('id', $id)->get()->first();
            if ($bonus != null) {
                $bonus->delete();
            }

            return redirect()->route('backend-system-bonus');
        }

        public function show(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $ok = false;

                if ($request->get('settings_bonus_amount_new') && $request->get('settings_bonus_percent_new')) {
                    $Namount = $request->input('settings_bonus_amount_new');
                    $Npercent = $request->input('settings_bonus_percent_new');

                    if (strlen($Namount) && strlen($Npercent)) {
                        Bonus::create([
                            'min_amount' => $Namount,
                            'percent' => $Npercent,
                        ]);

                        $ok = true;
                    }
                }

                if ($request->get('settings_bonus_ids')) {
                    $ids = explode(',', $request->input('settings_bonus_ids'));

                    foreach ($ids as $id) {
                        if ($request->get('settings_bonus_amount_'.$id) && $request->get('settings_bonus_percent_'.$id)) {
                            $amount = $request->input('settings_bonus_amount_'.$id);
                            $percent = $request->input('settings_bonus_percent_'.$id);

                            $bonus = Bonus::where('id', $id)->get()->first();
                            if ($bonus != null) {
                                $bonus->update([
                                    'min_amount' => $amount,
                                    'percent' => $percent,
                                ]);
                            }

                            $ok = true;
                        }
                    }
                }

                if ($ok) {
                    return redirect()->route('backend-system-bonus')->with([
                        'successMessage' => __('backend/main.changes_successfully'),
                    ]);
                }
            }

            $bbs = Bonus::orderByDesc('min_amount')->get();

            $ids = [];
            foreach ($bbs as $b) {
                $ids[] = $b->id;
            }

            return view('backend.system.bonus', [
                'bbs' => $bbs,
                'Ids' => implode(',', $ids),
            ]);
        }
    }
