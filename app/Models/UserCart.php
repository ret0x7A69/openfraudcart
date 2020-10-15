<?php

namespace App\Models;

    use App\Models\Coupon;
    use App\Models\Product;
    use App\Models\ProductBonus;
    use App\Models\Setting;
    use App\Models\UserCouponCheckout;
    use Auth;
    use Illuminate\Database\Eloquent\Model;

    class UserCart extends Model
    {
        protected $table = 'users_cart';

        protected $fillable = [
            'user_id', 'product_id', 'amount',
        ];

        public static function isEmpty($userid)
        {
            $amount = 0;

            foreach (self::getCartByUserId($userid) as $cartItem) {
                $amount += $cartItem[1];
            }

            return $amount <= 0;
        }

        public static function getCartTotalPriceCheckedCoupon($userid)
        {
            return self::getCartSubPriceCheckedCoupon($userid);
        }

        public static function getCartSubPriceCheckedCoupon($userid)
        {
            return self::getCartSubPriceCheckedCouponWithoutCurrency($userid).' '.Setting::getShopCurrency();
        }

        public static function getCartSubPriceCheckedCouponWithoutCurrency($userid)
        {
            return number_format(self::getCartSubInCentCheckedCoupon($userid) / 100, 2, ',', '.');
        }

        public static function getCartRabattInCent($userid)
        {
            $cent = self::getCartSubInCent($userid);

            $cartCoupon = UserCouponCheckout::where('user_id', Auth::user()->id)->get()->first();
            if ($cartCoupon != null) {
                $coupon = Coupon::where('code', $cartCoupon->coupon_code)->get()->first();

                if ($coupon != null) {
                    return $coupon->rabatt($cent);
                } else {
                    $cartCoupon->delete();
                }
            }

            return null;
        }

        public static function getCartRabatt($userid)
        {
            $cent = self::getCartSubInCent($userid);

            $cartCoupon = UserCouponCheckout::where('user_id', Auth::user()->id)->get()->first();
            if ($cartCoupon != null) {
                $coupon = Coupon::where('code', $cartCoupon->coupon_code)->get()->first();

                if ($coupon != null && $coupon->isPercent()) {
                    return number_format(str_replace(',', '.', $coupon->amount), 2).'%';
                }
            }

            return self::getCartRabattWithoutCurrency($userid).' '.Setting::getShopCurrency();
        }

        public static function getCartRabattWithoutCurrency($userid)
        {
            return number_format(self::getCartRabattInCent($userid) / 100, 2, ',', '.');
        }

        public static function getCartSubInCentCheckedCoupon($userid, $rabatt = true)
        {
            $cent = self::getCartSubInCent($userid);
            if (! $rabatt) {
                $cent = self::getCartSubInCentWithoutRabatt($userid);
            }

            $cartCoupon = UserCouponCheckout::where('user_id', Auth::user()->id)->get()->first();
            if ($cartCoupon != null) {
                $coupon = Coupon::where('code', $cartCoupon->coupon_code)->get()->first();

                if ($coupon != null) {
                    $cent = $coupon->toPay($cent);
                }
            }

            if ($cent < 0) {
                return 0;
            }

            return $cent;
        }

        public static function getCartTotalPrice($userid)
        {
            return self::getCartSubPrice($userid);
        }

        public static function getCartTotalInCentFromDrops($userid)
        {
            return self::getCartSubInCentFromDrops($userid);
        }

        public static function getCartSubInCentFromDropsWithoutRabatt($userid)
        {
            $cart = self::getCartByUserId($userid);

            $sub = 0;

            foreach ($cart as $cartItem) {
                $product = $cartItem[0];

                if ($product->dropNeeded()) {
                    $amount = $cartItem[1];

                    $sub += $amount * $product->price_in_cent;
                }
            }

            if ($sub < 0) {
                $sub = 0;
            }

            return $sub;
        }

        public static function getCartSubInCentFromDrops($userid)
        {
            $cart = self::getCartByUserId($userid);

            $sub = 0;

            foreach ($cart as $cartItem) {
                $product = $cartItem[0];

                if ($product->dropNeeded()) {
                    $amount = $cartItem[1];

                    $prc = $product->price_in_cent;

                    $bonuses = ProductBonus::where('product_id', $product->id)->orderByDesc('min_amount')->get();
                    foreach ($bonuses as $bonus) {
                        if ($amount >= $bonus->min_amount) {
                            $prc = $prc - floor($prc * $bonus->percent);
                            break;
                        }
                    }

                    $sub += $amount * $prc;
                }
            }

            if ($sub < 0) {
                $sub = 0;
            }

            return $sub;
        }

        public static function getCartTotalInCent($userid)
        {
            return self::getCartSubInCent($userid);
        }

        public static function getCartSubPrice($userid, $rabatt = true)
        {
            return self::getCartSubWithoutCurrency($userid, $rabatt).' '.Setting::getShopCurrency();
        }

        public static function getCartSubWithoutCurrency($userid, $rabatt = true)
        {
            if (! $rabatt) {
                return number_format(self::getCartSubInCentWithoutRabatt($userid, $rabatt) / 100, 2, ',', '.');
            }

            return number_format(self::getCartSubInCent($userid, $rabatt) / 100, 2, ',', '.');
        }

        public static function getCartSubInCentWithoutRabatt($userid)
        {
            $cart = self::getCartByUserId($userid);

            $sub = 0;

            foreach ($cart as $cartItem) {
                $product = $cartItem[0];
                $amount = $cartItem[1];

                $sub += $amount * $product->price_in_cent;
            }

            if ($sub < 0) {
                return 0;
            }

            return $sub;
        }

        public static function getCartSubInCent($userid)
        {
            $cart = self::getCartByUserId($userid);

            $sub = 0;

            foreach ($cart as $cartItem) {
                $product = $cartItem[0];
                $amount = $cartItem[1];

                $prc = $product->price_in_cent;

                $bonuses = ProductBonus::where('product_id', $product->id)->orderByDesc('min_amount')->get();
                foreach ($bonuses as $bonus) {
                    if ($amount >= $bonus->min_amount) {
                        $prc = $prc - floor($prc * $bonus->percent);
                        break;
                    }
                }

                $sub += $amount * $prc;
            }

            if ($sub < 0) {
                return 0;
            }

            return $sub;
        }

        public static function getCartCountByUserId($userid)
        {
            /*
            $count = 0;

            foreach(self::getCartByUserId($userid) as $cart) {
                $count += $cart[1];
            }

            return $count;
            */

            return count(self::getCartByUserId($userid));
        }

        public static function hasDroplestProducts($userid)
        {
            foreach (self::getCartByUserId($userid) as $cartItem) {
                if ($cartItem[0]->dropNeeded()) {
                    return true;
                }
            }

            return false;
        }

        public static function getCartByUserId($userid)
        {
            $cart = [];

            foreach (self::where('user_id', $userid)->get() as $userCart) {
                $product = Product::where('id', $userCart->product_id)->get()->first();

                if ($product == null) {
                    self::where([
                        ['user_id', '=', Auth::user()->id],
                        ['product_id', '=', $userCart->product_id],
                    ])->delete();

                    continue;
                }

                if (! $product->isUnlimited() && ! $product->isAvailableAmount($userCart->amount)) {
                    $newAmount = 1;

                    if ($product->asWeight()) {
                        $newAmount = $product->getWeightAvailable();
                    } else {
                        $newAmount = $product->getStock();
                    }

                    $userCart->update([
                        'amount' => $newAmount,
                    ]);
                }

                $amount = $userCart->amount;

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

                        $userCart->update([
                            'amount' => $amount,
                        ]);
                    }
                }

                $total = $product->price_in_cent * $userCart->amount;

                $cart[] = [
                    $product, $userCart->amount, $total,
                ];
            }

            return $cart;
        }

        public function getProduct()
        {
            $product = Product::where('id', $this->product_id)->get()->first();

            return $product;
        }
    }
