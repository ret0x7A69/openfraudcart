<?php

namespace App\Http\Controllers\Shop;

    use App\Http\Controllers\Controller;
    use App\Models\DeliveryMethod;
    use App\Models\FAQ;
    use App\Models\Notification;
    use App\Models\Product;
    use App\Models\ProductCategory;
    use App\Models\ProductItem;
    use App\Models\Setting;
    use App\Models\UserOrder;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class ShopController extends Controller
    {
        public function __construct()
        {
            if (Setting::get('app.access_only_for_users', false)) {
                $this->middleware('auth');
            }
        }

        public function showShopPage()
        {
            $categories = ProductCategory::orderByDesc('created_at')->get();

            return view('frontend/shop.shop', [
                'metaTITLE' => __('frontend/shop.meta.title.shop'),
                'metaDESC' => __('frontend/shop.meta.desc.shop'),
                'categories' => $categories,
                'showHeader' => true,
            ]);
        }

        public function buyProductForm(Request $request, $pId = null, $pAmount = null)
        {
            if (! Auth::check()) {
                return redirect()->route('shop')->with([
                    'errorMessage' => __('frontend/shop.must_logged_in'),
                ]);
            }

            $backAction = false;
            if ($pId != null && $pAmount != null) {
                $backAction = true;
            }

            if ($request->getMethod() == 'POST' || $backAction) {
                if ($backAction) {
                    $productId = $pId;
                } else {
                    $productId = $request->get('product_id');
                }

                $product = Product::where('id', $productId)->get()->first();

                if ($product == null) {
                    return redirect()->route('shop')->with([
                        'errorMessage' => __('frontend/shop.product_not_found'),
                    ]);
                }

                if ($backAction) {
                    $amount = $pAmount;
                } else {
                    $amount = intval($request->get('product_amount'));
                }

                if ($product->asWeight() && $amount > $product->getWeightAvailable()) {
                    $amount = $product->getWeightAvailable();
                } elseif (! $product->asWeight() && ! $product->isUnlimited() && $amount > $product->getStock()) {
                    $amount = $product->getStock();
                }

                if ($amount <= 0) {
                    return redirect()->route('shop');
                }

                if ($product->asWeight() && $product->getInterval() > 1) {
                    if ($amount % $product->getInterval() != 0) {
                        $amount = round($amount / $product->getInterval(), 0, \PHP_ROUND_HALF_DOWN) * $product->getInterval();

                        if ($amount > $product->getWeightAvailable()) {
                            $amount = $product->getWeightAvailable();
                        }

                        if ($amount == 0 && $product->getWeightAvailable() >= $product->getInterval()) {
                            $amount = $product->getInterval();
                        } elseif ($amount == 0) {
                            return redirect()->route('shop');
                        }
                    }
                }

                $totalPriceInCent = \App\Classes\Rabatt::newprice($product->price_in_cent * $amount, $product->id, $amount);
                $bonus = null;
                $xx = \App\Classes\Rabatt::rabattpriceformat($product->price_in_cent * $amount, $product->id, $amount);
                $bonus = $xx;

                $totalPrice = Product::formatPrice($totalPriceInCent);

                $replaceEntry = FAQ::where('id', Setting::get('shop.replace_rules'))->first();

                return view('frontend/shop.product_confirm_buy', [
                    'product' => $product,
                    'amount' => $amount,
                    'totalPrice' => $totalPrice,
                    'totalPriceInCent' => $totalPriceInCent,
                    'bonus' => $bonus,
                    'replaceEntry' => $replaceEntry,
                ]);
            }

            return redirect()->route('shop');
        }

        public function buyProductConfirmForm(Request $request)
        {
            if (! Auth::check()) {
                return redirect()->route('shop')->with([
                    'errorMessage' => __('frontend/shop.must_logged_in'),
                ]);
            }

            if ($request->getMethod() == 'POST') {
                $productId = $request->get('product_id');
                $amount = intval($request->get('product_amount'));

                $product = Product::where('id', $productId)->get()->first();

                if ($product == null) {
                    return redirect()->route('shop')->with([
                        'errorMessage' => __('frontend/shop.product_not_found'),
                    ]);
                }

                $dropInfo = '';
                $status = 'nothing';

                $deliveryMethodId = 0;
                $deliveryMethodName = '';
                $deliveryMethodPrice = 0;

                $extraCosts = 0;

                if ($product->dropNeeded()) {
                    $status = 'pending';

                    $deliveryMethodId = $request->get('product_delivery_method') ?? 0;
                    $deliveryMethod = DeliveryMethod::where('id', $deliveryMethodId)->get()->first();

                    if ($deliveryMethod == null || ! $deliveryMethod->isAvailableAmount($product->price_in_cent * $amount)) {
                        return redirect()->route('buy-product', [$productId, $amount])->with([
                            'errorMessage' => __('frontend/shop.delivery_method_needed'),
                            'productDrop' => $dropInfo,
                        ]);
                    } else {
                        $extraCosts += $deliveryMethod->price;
                        $deliveryMethodName = $deliveryMethod->name;
                        $deliveryMethodPrice = $deliveryMethod->price;
                    }

                    if ($request->get('product_drop') == null) {
                        return redirect()->route('buy-product', [$productId, $amount])->with([
                            'errorMessage' => __('frontend/shop.order_note_needed'),
                            'productDrop' => $dropInfo,
                        ]);
                    } elseif (strlen($request->get('product_drop')) > 500) {
                        return redirect()->route('buy-product', [$productId, $amount])->with([
                            'errorMessage' => __('frontend/shop.order_note_long', [
                                'charallowed' => 500,
                            ]),
                            'productDrop' => $dropInfo,
                        ]);
                    } else {
                        $dropInfo = encrypt($request->get('product_drop'));
                    }
                }

                if ($amount > 0 && ($product->isAvailableAmount($amount) || $product->isUnlimited())) {
                    /*if($product->isUnlimited()) {
                        $amount = 1;
                    }*/

                    $priceInCent = \App\Classes\Rabatt::newprice($product->price_in_cent * $amount, $product->id, $amount);

                    $priceInCent += $extraCosts;

                    if (Auth::user()->balance_in_cent >= $priceInCent) {
                        $newBalance = Auth::user()->balance_in_cent - $priceInCent;

                        Auth::user()->update([
                            'balance_in_cent' => $newBalance,
                        ]);

                        if ($product->isUnlimited()) {
                            UserOrder::create([
                                'user_id' => Auth::user()->id,
                                'name' => $product->name,
                                'content' => $product->content,
                                'amount' => $amount,
                                'price_in_cent' => $product->price_in_cent,
                                'totalprice' => $priceInCent,
                                'drop_info' => $dropInfo,
                                'delivery_price' => $deliveryMethodPrice,
                                'delivery_method' => $deliveryMethodName,
                                'status' => $status,
                                'weight' => 0,
                                'weight_char' => '',
                            ]);

                            $product->update([
                                'sells' => $product->sells + 1,
                            ]);

                            Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + 1);

                            Notification::create([
                                'custom_id' => Auth::user()->id,
                                'type' => 'order',
                            ]);

                            return redirect()->route('orders-with-pageNumber', 1)->with([
                                'successMessage' => __('frontend/shop.you_bought_with_amount', [
                                    'name' => $product->name,
                                    'amount' => $amount,
                                    'totalprice' => Product::formatPrice($priceInCent),
                                    'price' => $product->getFormattedPrice(),
                                ]),
                            ]);
                        } elseif ($product->asWeight()) {
                            UserOrder::create([
                                'user_id' => Auth::user()->id,
                                'name' => $product->name,
                                'amount' => 1,
                                'content' => $product->content,
                                'weight' => $amount,
                                'weight_char' => $product->getWeightChar(),
                                'price_in_cent' => $product->price_in_cent,
                                'totalprice' => $priceInCent,
                                'drop_info' => $dropInfo,
                                'delivery_price' => $deliveryMethodPrice,
                                'delivery_method' => $deliveryMethodName,
                                'status' => $status,
                            ]);

                            $product->update([
                                'sells' => $product->sells + $amount,
                                'weight_available' => $product->weight_available - $amount,
                            ]);

                            Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + 1);

                            Notification::create([
                                'custom_id' => Auth::user()->id,
                                'type' => 'order',
                            ]);

                            return redirect()->route('orders-with-pageNumber', 1)->with([
                                'successMessage' => __('frontend/shop.you_bought_with_amount2', [
                                    'name' => $product->name,
                                    'amount_with_char' => $amount.$product->getWeightChar(),
                                    'totalprice' => Product::formatPrice($priceInCent),
                                    'price' => $product->getFormattedPrice(),
                                ]),
                            ]);
                        } else {
                            /*
                            * New order adding logic
                            */
                            $productContent = '';
                            $itemIDsToDestroy = [];
                            $productItems = ProductItem::where('product_id', $product->id)->take($amount)->get();
                            foreach ($productItems as $item) {
                                $productContent .= $item->content . '\r\n' . '\r\n';
                                array_push($itemIDsToDestroy, $item->id);
                            }
 
                            $product->update([
                                'sells' => $product->sells + $amount
                            ]);
                            
                            ProductItem::destroy($itemIDsToDestroy);
                            
                            Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + $amount);
 
                            UserOrder::create([
                                'user_id' => Auth::user()->id,
                                'name' => $product->name,
                                'amount' => $amount,
                                'content' => $productContent,
                                'price_in_cent' => $product->price_in_cent,
                                'totalprice' => $priceInCent,
                                'weight' => 0,
                                'weight_char' => '',
                                'status' => $status,
                                'delivery_price' => $deliveryMethodPrice,
                                'delivery_method' => $deliveryMethodName,
                                'drop_info' => $dropInfo
                            ]);
 
                            Notification::create([
                                'custom_id' => Auth::user()->id,
                                'type' => 'order'
                            ]);
 
                            return redirect()->route('orders-with-pageNumber', 1)->with([
                                'successMessage' => __('frontend/shop.you_bought_with_amount', [
                                    'name' => $product->name,
                                    'amount' => $amount,
                                    'totalprice' => Product::formatPrice($priceInCent),
                                    'price' => $product->getFormattedPrice()
                                ])
                            ]);
                        }
                    } else {
                        return redirect()->route('buy-product', [
                            'id' => $productId,
                            'amount' => $amount,
                        ])->with([
                            'errorMessage' => __('frontend/shop.not_enought_money'),
                        ]);
                    }
                } else {
                    return redirect()->route('shop')->with([
                        'errorMessage' => __('frontend/shop.product_not_available'),
                    ]);
                }
            }

            return redirect()->route('shop');
        }

        public function showProductPage($productId)
        {
            $product = Product::where('id', $productId)->get()->first();

            if ($product != null) {
                return view('frontend/shop.product', [
                    'metaTITLE' => strip_tags($product->name),
                    'metaDESC' => strip_tags(substr(strlen($product->description) ? decrypt($product->description) : '', 0, 65)),
                    'product' => $product,
                    'productShowLongDes' => true,
                ]);
            }

            return view('frontend/shop.product_not_found');
        }

        public function showProductCategoryPage($slug = null)
        {
            if ($slug == null && strtolower($slug) != 'uncategorized') {
                return redirect()->route('shop');
            }

            $productCategory = ProductCategory::where('slug', $slug)->get()->first();

            if ($productCategory == null && $slug != 'uncategorized') {
                return redirect()->route('shop');
            } elseif ($productCategory == null) {
                $products = Product::getUncategorizedProducts();
            } else {
                $products = Product::where('category_id', $productCategory->id)->get()->all();
            }

            return view('frontend/shop.products_category', [
                'products' => $products,
                'productCategory' => $productCategory ?? (object) ['name' => __('frontend/shop.uncategorized')],
                'productCategoryUncategorized' => $productCategory == null ? true : false,
            ]);
        }
    }
