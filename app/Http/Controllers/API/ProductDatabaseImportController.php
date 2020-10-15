<?php

namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use App\Models\ProductItem;
    use App\Models\Setting;
    use Illuminate\Http\Request;

    class ProductDatabaseImportController extends Controller
    {
        public function __construct()
        {
        }

        public function databaseImportLineByLine(Request $request)
        {
            $response = [
                'error' => 'UNKNOWN_ERROR',
            ];

            if (Setting::get('api.enabled', 0)) {
                $apiKey = $request->get('key') ?? '';
                $apiKeyReal = strlen(Setting::get('api.key')) > 0 ? decrypt(Setting::get('api.key')) : '';

                if (strlen($apiKey) > 0 && $apiKeyReal === $apiKey) {
                    $productId = $request->get('product_id') ?? 0;
                    $input = $request->get('input') ?? '';

                    $product = Product::where('id', $productId)->get()->first();

                    if ($product != null) {
                        if (strlen($input) > 0) {
                            $items = explode("\n", trim($input));
                            $items = array_filter($items, 'trim');

                            $count = 0;

                            foreach ($items as $line) {
                                if (strlen($line) <= 0) {
                                    continue;
                                }

                                if (ProductItem::create([
                                    'product_id' => $productId,
                                    'content' => encrypt($line),
                                ])) {
                                    $count++;
                                }
                            }

                            if ($count > 0) {
                                $response = [
                                    'success' => true,
                                    'entries' => $count,
                                ];
                            }
                        } else {
                            $response['error'] = 'CONTENT_EMPTY';
                        }
                    } else {
                        $response['error'] = 'INVALID_PRODUCT_ID';
                    }
                } else {
                    $response['error'] = 'INVALID_API_KEY';
                }
            } else {
                $response['error'] = 'API_NOT_ENABLED';
            }

            return response()->json($response);
        }

        public function databaseImportSeperator(Request $request)
        {
            $response = [
                'error' => 'UNKNOWN_ERROR',
            ];

            if (Setting::get('api.enabled', 0)) {
                $apiKey = $request->get('key') ?? '';
                $apiKeyReal = strlen(Setting::get('api.key')) > 0 ? decrypt(Setting::get('api.key')) : '';

                if (strlen($apiKey) > 0 && $apiKeyReal === $apiKey) {
                    $productId = $request->get('product_id') ?? 0;
                    $input = $request->get('input') ?? '';

                    $product = Product::where('id', $productId)->get()->first();

                    if ($product != null) {
                        if (strlen($input) > 0) {
                            $seperator = $request->get('seperator') ?? null;

                            if ($seperator != null && strlen($seperator) > 0) {
                                $items = explode($seperator, trim($input));
                                $items = array_filter($items, 'trim');

                                $count = 0;

                                foreach ($items as $line) {
                                    if (strlen($line) <= 0) {
                                        continue;
                                    }

                                    if (ProductItem::create([
                                        'product_id' => $productId,
                                        'content' => encrypt($line),
                                    ])) {
                                        $count++;
                                    }
                                }

                                if ($count > 0) {
                                    $response = [
                                        'success' => true,
                                        'entries' => $count,
                                    ];
                                }
                            } else {
                                $response['error'] = 'NO_SEPERATOR';
                            }
                        } else {
                            $response['error'] = 'CONTENT_EMPTY';
                        }
                    } else {
                        $response['error'] = 'INVALID_PRODUCT_ID';
                    }
                } else {
                    $response['error'] = 'INVALID_API_KEY';
                }
            } else {
                $response['error'] = 'API_NOT_ENABLED';
            }

            return response()->json($response);
        }

        public function databaseImport(Request $request)
        {
            $response = [
                'error' => 'UNKNOWN_ERROR',
            ];

            if (Setting::get('api.enabled', 0)) {
                $apiKey = $request->get('key') ?? '';
                $apiKeyReal = strlen(Setting::get('api.key')) > 0 ? decrypt(Setting::get('api.key')) : '';

                if (strlen($apiKey) > 0 && $apiKeyReal === $apiKey) {
                    $productId = $request->get('product_id') ?? 0;
                    $content = $request->get('content') ?? '';

                    $product = Product::where('id', $productId)->get()->first();

                    if ($product != null) {
                        if (strlen($content) > 0) {
                            if (ProductItem::create([
                                'product_id' => $productId,
                                'content' => encrypt($content),
                            ])) {
                                $response = [
                                    'success' => true,
                                ];
                            }
                        } else {
                            $response['error'] = 'CONTENT_EMPTY';
                        }
                    } else {
                        $response['error'] = 'INVALID_PRODUCT_ID';
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
