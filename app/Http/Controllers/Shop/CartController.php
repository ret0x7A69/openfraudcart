<?php

namespace App\Http\Controllers\Shop;

    use App\Http\Controllers\Controller;
    use App\Models\Coupon;
    use App\Models\DeliveryMethod;
    use App\Models\Product;
    use App\Models\ProductItem;
    use App\Models\Setting;
    use App\Models\UserCart;
    use App\Models\UserCartEntry;
    use App\Models\UserCartShopping;
    use App\Models\UserCoupon;
    use App\Models\UserCouponCheckout;
    use App\Models\UserOrder;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class CartController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        public function checkoutSubmit(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                if (! UserCart::isEmpty(Auth::user()->id)) {
                    $extraCosts = 0;
                    $deliveryMethodName = '';
                    $deliveryMethodPrice = 0;

                    // DELIVERY METHOD
                    if (UserCart::hasDroplestProducts(Auth::user()->id)) {
                        $deliveryMethodId = $request->get('product_delivery_method') ?? 0;
                        $deliveryMethod = DeliveryMethod::where('id', $deliveryMethodId)->get()->first();

                        if ($deliveryMethod == null || ! $deliveryMethod->isAvailableForUsersCart()) {
                            return redirect()->route('checkout')->with([
                                'errorMessage' => __('frontend/shop.delivery_method_needed'),
                            ]);
                        } else {
                            $extraCosts += $deliveryMethod->price;
                            $deliveryMethodName = $deliveryMethod->name;
                            $deliveryMethodPrice = $deliveryMethod->price;
                        }
                    }

                    // DROP
                    $dropInput = $request->get('product_drop') ?? '';
                    if (UserCart::hasDroplestProducts(Auth::user()->id)) {
                        if (strlen($dropInput) > 500) {
                            return redirect()->route('checkout')->with([
                                'errorMessage' => __('frontend/shop.order_note_long', [
                                    'charallowed' => 500,
                                ]),
                            ]);
                        }

                        if (strlen($dropInput) <= 0) {
                            return redirect()->route('checkout')->with([
                                'errorMessage' => __('frontend/shop.order_note_needed'),
                            ]);
                        }

                        $dropInput = encrypt($request->get('product_drop'));
                    }

                    $cartTotal = UserCart::getCartSubInCent(Auth::user()->id);
                    $total = $cartTotal;

                    if (count(Auth::user()->getCheckoutCoupons()) > 0) {
                        $userCouponCheckout = UserCouponCheckout::where('user_id', Auth::user()->id)->get()->first();

                        if ($userCouponCheckout != null) {
                            $coupon = Coupon::where('code', $userCouponCheckout->coupon_code)->get()->first();

                            if ($coupon != null) {
                                $total = $coupon->toPay($total);
                            }
                        }

                        //$total = \App\Classes\Rabatt::newprice($total);

                        $total = $total + $extraCosts;
                    }
                    $coupon = null;
                    if (Auth::user()->balance_in_cent >= $total) {
                        if ($coupon != null) {
                            $coupon->update([
                                'used' => $coupon->used + 1,
                            ]);

                            UserCoupon::create([
                                'user_id' => Auth::user()->id,
                                'counpon_id' => $coupon->id,
                            ]);
                        }

                        $createShopping = false;
                        $cartEntries = [];

                        foreach (UserCart::getCartByUserId(Auth::user()->id) as $cartItem) {
                            if ($cartItem[0] == null) {
                                return redirect()->route('checkout')->with([
                                    'errorMessage' => __('frontend/v4.cart_error1'),
                                ]);
                            }

                            if (! $cartItem[0]->isUnlimited() && ! $cartItem[0]->isAvailableAmount($cartItem[1])) {
                                return redirect()->route('checkout')->with([
                                    'errorMessage' => __('frontend/v4.cart_error2'),
                                ]);
                            }

                            // HISTORY
                            $product = $cartItem[0];

                            $status = 'nothing';
                            $dropInfo = '';
                            $deliveryMethodNameX = '';
                            $deliveryMethodPriceX = 0;

                            if ($product->dropNeeded()) {
                                $status = 'pending';
                                $dropInfo = $dropInput;

                                $deliveryMethodNameX = $deliveryMethodName;
                                $deliveryMethodPriceX = $deliveryMethodPrice;
                            }

                            if ($product->isUnlimited()) {
                                $order = UserOrder::create([
                                    'user_id' => Auth::user()->id,
                                    'name' => $product->name,
                                    'content' => $product->content,
                                    'amount' => $cartItem[1],
                                    'price_in_cent' => $product->price_in_cent,
                                    'totalprice' => $cartItem[2],
                                    'drop_info' => $dropInfo,
                                    'delivery_price' => $deliveryMethodPriceX,
                                    'delivery_method' => $deliveryMethodNameX,
                                    'status' => $status,
                                    'weight' => 0,
                                    'weight_char' => '',
                                ]);

                                if ($product->dropNeeded()) {
                                    if ($order != null) {
                                        $createShopping = true;
                                        $cartEntries[] = [
                                            'product_id' => $product->id,
                                            'order_id' => $order->id,
                                            'user_id' => Auth::user()->id,
                                        ];
                                    }
                                }

                                $product->update([
                                    'sells' => $product->sells + $cartItem[1],
                                ]);

                                Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + $cartItem[1]);
                            } elseif ($product->asWeight()) {
                                $order = UserOrder::create([
                                    'user_id' => Auth::user()->id,
                                    'name' => $product->name,
                                    'amount' => 1,
                                    'content' => $product->content,
                                    'weight' => $cartItem[1],
                                    'weight_char' => $product->getWeightChar(),
                                    'price_in_cent' => $product->price_in_cent,
                                    'totalprice' => $cartItem[2],
                                    'drop_info' => $dropInfo,
                                    'delivery_price' => $deliveryMethodPriceX,
                                    'delivery_method' => $deliveryMethodNameX,
                                    'status' => $status,
                                ]);

                                if ($product->dropNeeded()) {
                                    if ($order != null) {
                                        $createShopping = true;
                                        $cartEntries[] = [
                                            'product_id' => $product->id,
                                            'order_id' => $order->id,
                                            'user_id' => Auth::user()->id,
                                        ];
                                    }
                                }

                                $product->update([
                                    'sells' => $product->sells + $cartItem[1],
                                    'weight_available' => $product->weight_available - $cartItem[1],
                                ]);

                                Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + 1);
                            } else {
                                /*
                                * New order adding logic
                                */
                                $priceInCent = \App\Classes\Rabatt::newprice($product->price_in_cent * $cartItem[1], $product->id, $cartItem[1]);

                                $productContent = '';
                                $itemIDsToDestroy = [];
                                $productItems = ProductItem::where('product_id', $product->id)->take($cartItem[1])->get();
                                foreach ($productItems as $item) {
                                    $productContent .= $item->content . '\r\n' . '\r\n';
                                    array_push($itemIDsToDestroy, $item->id);
                                }
    
                                $product->update([
                                    'sells' => $product->sells + $cartItem[1]
                                ]);
                                
                                ProductItem::destroy($itemIDsToDestroy);
                                
                                Setting::set('shop.total_sells', Setting::get('shop.total_sells', 0) + $cartItem[1]);
    
                                UserOrder::create([
                                    'user_id' => Auth::user()->id,
                                    'name' => $product->name,
                                    'amount' => $cartItem[1],
                                    'content' => $productContent,
                                    'price_in_cent' => $product->price_in_cent,
                                    'totalprice' => $priceInCent,
                                    'weight' => 0,
                                    'weight_char' => '',
                                    'status' => $status,
                                    'delivery_price' => $deliveryMethodPriceX,
                                    'delivery_method' => $deliveryMethodNameX,
                                    'drop_info' => $dropInfo
                                ]);
                            }
                        }

                        if ($createShopping && count($cartEntries) > 1) {
                            $shopping = UserCartShopping::create([
                                'user_id' => Auth::user()->id,
                            ]);

                            if ($shopping != null) {
                                foreach ($cartEntries as $cartEntry) {
                                    UserCartEntry::create([
                                        'user_id' => $cartEntry['user_id'],
                                        'order_id' => $cartEntry['order_id'],
                                        'product_id' => $cartEntry['product_id'],
                                        'shopping_id' => $shopping->id,
                                    ]);
                                }
                            }
                        }

                        // CLEAR CART

                        UserCart::where([
                            ['user_id', '=', Auth::user()->id],
                        ])->delete();

                        // SUCCESS PART

                        $newBalance = Auth::user()->balance_in_cent - $total;

                        // COUPON
                        if (count(Auth::user()->getCheckoutCoupons()) > 0) {
                            $userCouponCheckout = UserCouponCheckout::where('user_id', Auth::user()->id)->get()->first();

                            if ($userCouponCheckout != null) {
                                $coupon = Coupon::where('code', $userCouponCheckout->id)->get()->first();

                                if ($coupon != null) {
                                    $coupon->update([
                                        'used' => $coupon->used + 1,
                                    ]);

                                    UserCoupon::create([
                                        'user_id' => Auth::user()->id,
                                        'coupon_id' => $coupon->id,
                                    ]);
                                }

                                $userCouponCheckout->delete();
                            }
                        }

                        Auth::user()->update([
                            'balance_in_cent' => $newBalance,
                        ]);

                        return redirect()->route('orders')->with([
                            'successMessage' => __('frontend/v4.thank_you'),
                        ]);
                    } else {
                        return redirect()->route('checkout')->with([
                            'errorMessage' => __('frontend/shop.not_enought_money'),
                        ]);
                    }
                }
            }

            return redirect()->route('cart');
        }

        public function checkout()
        {
            if (UserCart::isEmpty(Auth::user()->id)) {
                return redirect()->route('cart');
            }

            return view('frontend/shop.checkout', [
                'cart' => UserCart::getCartByUserId(Auth::user()->id),
            ]);
        }

        public function clear()
        {
            UserCart::where([
                ['user_id', '=', Auth::user()->id],
            ])->delete();

            return redirect()->route('cart');
        }

        public function delete($product_id)
        {
            UserCart::where([
                ['product_id', '=', $product_id],
                ['user_id', '=', Auth::user()->id],
            ])->delete();

            return redirect()->route('cart');
        }

        public function cart(Request $request)
        {
            echo __('frontend/v4.cart_widget', [
                'count' => UserCart::getCartCountByUserId(Auth::user()->id),
                'price' => UserCart::getCartSubPrice(Auth::user()->id),
            ]);
        }

        public function ajaxAddItem(Request $request)
        {
            if ($request->getMethod() == 'POST') {
                $productId = intval($request->get('product_id') ?? '0');
                $amount = intval($request->get('amount') ?? '0');

                $product = Product::where('id', $productId)->get()->first();

                if ($product != null) {
                    $userCartItem = UserCart::where([
                        ['product_id', '=', $productId],
                        ['user_id', '=', Auth::user()->id],
                    ])->get()->first();

                    if ($userCartItem != null) {
                        $newAmount = $userCartItem->amount + $amount;

                        $userCartItem->update([
                            'amount' => $newAmount,
                        ]);
                    } else {
                        UserCart::create([
                            'product_id' => $product->id,
                            'amount' => $amount,
                            'user_id' => Auth::user()->id,
                        ]);
                    }
                }
            }
        }

        public function show()
        {
            return view('frontend/shop.cart', [
                'cart' => UserCart::getCartByUserId(Auth::user()->id),
            ]);
        }
    }
