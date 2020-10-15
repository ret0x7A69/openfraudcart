<?php

namespace App\Http\Controllers\API;

    use App\Classes\BitcoinAPI;
    use App\Http\Controllers\Controller;
    use App\Models\Setting;
    use Illuminate\Http\Request;

    class BitcoinWalletController extends Controller
    {
        public function __construct()
        {
        }

        public function bitcoinWalletInfo(Request $request)
        {
            $response = [
                'error' => 'UNKNOWN_ERROR',
            ];

            if (Setting::get('api.enabled', 0)) {
                $apiKey = $request->get('key') ?? '';
                $apiKeyReal = strlen(Setting::get('api.key')) > 0 ? decrypt(Setting::get('api.key')) : '';

                if (strlen($apiKey) > 0 && $apiKeyReal === $apiKey) {
                    if (BitcoinAPI::connected()) {
                        $response = [
                            'balance' => BitcoinAPI::getServerBalance(),
                            'balance_formatted' => BitcoinAPI::getFormattedServerBalance(),
                            'recommended_fee_btc' => BitcoinAPI::getRecommendedFee()['btc'],
                            'recommended_fee_satoshi' => BitcoinAPI::getRecommendedFee()['satoshi'],
                        ];
                    } else {
                        $response['error'] = 'BITCOIN_NODE_NOT_CONNECTED';
                    }
                } else {
                    $response['error'] = 'INVALID_API_KEY';
                }
            } else {
                $response['error'] = 'API_NOT_ENABLED';
            }

            return response()->json($response);
        }
    }
