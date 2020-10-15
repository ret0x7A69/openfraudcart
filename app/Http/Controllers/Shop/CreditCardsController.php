<?php

namespace App\Http\Controllers\Shop;

    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Support\Facades\Auth;

    class CreditCardsController extends Controller
    {
        public function __construct()
        {
            if (Setting::get('app.access_only_for_users', false)) {
                $this->middleware('auth');
            }

            $this->middleware('creditcards');
        }

        public function showCreditCardsPage()
        {
            /*$creditcards = CreditCard::orderByDesc('created_at')->paginate(10, ['*'], 'page', $pageNumber);

            if($pageNumber > $creditcards->lastPage() || $pageNumber <= 0) {
                return redirect()->route('creditcards-with-pageNumber', 1);
            }*/

            return view('frontend/shop.creditcards.list', [
                //'creditcards' => $creditcards,
                'managementPage' => true,
            ]);
        }
    }
