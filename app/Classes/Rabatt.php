<?php

namespace App\Classes;

    use App\Models\Product;
    use App\Models\ProductBonus;
    use App\Models\Setting;

    class Rabatt
    {
        public static function rabattpriceformat($cent, $pid = 0, $amount = 0)
        {
            return self::withoutCurrencyX($cent, $pid, $amount).' '.Setting::getShopCurrency();
        }

        public static function withoutCurrencyX($cent, $pid, $a)
        {
            return number_format(self::rabattprice($cent, $pid, $a) / 100, 2, ',', '.');
        }

        public static function rabattprice($price, $productId = 0, $amount = 0)
        {
            return floor($price * self::rab($productId, $amount));
        }

        public static function rab($pid, $amount)
        {
            $product = Product::where('id', $pid)->get()->first();

            if ($product != null) {
                $bonuses = ProductBonus::where('product_id', $pid)->orderByDesc('min_amount')->get();

                foreach ($bonuses as $bonus) {
                    if ($amount >= $bonus->min_amount) {
                        return $bonus->percent;
                    }
                }
            }

            /*
            * Default Rab of 0% instead of 100% lel
            */
            return 0;
        }

        public static function newprice($price, $productId = 0, $amount = 0)
        {
            return $price - floor($price * self::rab($productId, $amount));
        }

        public static function price($price)
        {
            return $price;
        }

        public static function priceformat($cent)
        {
            return self::withoutCurrency($cent).' '.Setting::getShopCurrency();
        }

        public static function priceformat2($cent)
        {
            return self::withoutCurrency2($cent).' '.Setting::getShopCurrency();
        }

        public static function withoutCurrency($cent)
        {
            return number_format(self::price($cent) / 100, 2, ',', '.');
        }

        public static function withoutCurrency2($cent)
        {
            return number_format(self::price2($cent) / 100, 2, ',', '.');
        }
    }
