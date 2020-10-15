<?php

namespace App\Http\Controllers\Backend\Bitcoin;

    use App\Classes\BitcoinAPI;
    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use App\Models\UserTransaction;
    use Illuminate\Http\Request;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Validator;

    class DashboardController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_bitcoin_wallet');
        }

        public function setPrimaryWalletForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'bitcoin_primarywallet_address' => 'required',
                ]);

                $bitcoind = BitcoinAPI::getBitcoinClient();

                $walletAddress = $request->input('bitcoin_primarywallet_address');

                if ((strlen($walletAddress) > 0 && $bitcoind->validateaddress($walletAddress)['isvalid']) || strlen($walletAddress) == 0) {
                    if (strlen($walletAddress) > 0) {
                        Setting::set('bitcoin.primarywallet', encrypt($walletAddress));

                        return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                            'successMessage' => __('backend/bitcoin.primarywallet.successfully', [
                                'address' => $walletAddress,
                            ]),
                        ]);
                    } else {
                        Setting::set('bitcoin.primarywallet', '');

                        return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                            'successMessage' => __('backend/bitcoin.primarywallet.successfully2'),
                        ]);
                    }
                } else {
                    return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                        'errorMessage' => __('backend/bitcoin.primarywallet.unknown_error'),
                    ]);
                }
            }
        }

        public function sendBtcForm(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $validator = Validator::make($request->all(), [
                    'bitcoin_sendbtc_address' => 'required',
                    'bitcoin_sendbtc_amount' => 'required',
                    'bitcoin_sendbtc_fee' => 'required',
                ]);

                if (! $validator->fails()) {
                    $bitcoind = BitcoinAPI::getBitcoinClient();

                    $walletAddress = $request->input('bitcoin_sendbtc_address');
                    $amount = $request->input('bitcoin_sendbtc_amount');
                    $fee = $request->input('bitcoin_sendbtc_fee');

                    if (strlen($walletAddress) > 0 && $amount > 0 && $bitcoind->getbalance() >= $amount && $bitcoind->validateaddress($walletAddress)['isvalid']) {
                        $bitcoind->settxfee((string) $fee);

                        if ($bitcoind->sendtoaddress($walletAddress, $amount)) {
                            return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                                'successMessage' => __('backend/bitcoin.sendbtc.successfully', [
                                    'address' => $walletAddress,
                                    'amount' => $amount,
                                ]),
                            ]);
                        } else {
                            return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                                'errorMessage' => __('backend/bitcoin.sendbtc.unknown_error'),
                            ]);
                        }
                    } else {
                        return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->with([
                            'errorMessage' => __('backend/bitcoin.sendbtc.unknown_error'),
                        ]);
                    }
                }

                $request->flash();

                return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1)->withErrors($validator)->withInput();
            }

            return redirect()->route('backend-bitcoin-dashboard');
        }

        public function showDashboardPage(Request $request, $pageNumber = 0)
        {
            $transactions = [];

            $isConnected = BitcoinAPI::connected();

            if ($isConnected) {
                $listtransactions = BitcoinAPI::getBitcoinClient()->listtransactions();

                for ($i = 0; $i < count($listtransactions); $i++) {
                    $transactions[] = $listtransactions[$i];
                }

                array_reverse($transactions);
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($transactions);
            $perPage = 15;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedTransactions = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $paginatedTransactions->setPath($request->url());

            //$transactions = UserTransaction::orderByDesc('created_at')->paginate(15, ['*'], 'page', $pageNumber);

            if ($pageNumber > $paginatedTransactions->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-bitcoin-dashboard-with-pageNumber', 1);
            }

            return view('backend.bitcoin.dashboard', [
                'transactions' => $paginatedTransactions,
                'isConnected' => $isConnected,
            ]);
        }
    }
