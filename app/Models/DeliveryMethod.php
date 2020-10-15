<?php

namespace App\Models;

    use App\Models\Setting;
    use App\Models\UserCart;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Auth;

    class DeliveryMethod extends Model
    {
        protected $table = 'delivery_methods';

        protected $fillable = [
            'price', 'name', 'min_amount', 'max_amount',
        ];

        public function isAvailableForUsersCart()
        {
            $return = true;

            $total = UserCart::getCartTotalInCentFromDrops(Auth::user()->id);

            if ($this->min_amount > 0 && $total < $this->min_amount) {
                $return = false;
            }

            if ($this->max_amount > 0 && $total > $this->max_amount) {
                $return = false;
            }

            return $return;
        }

        public function isAvailableAmount($cent)
        {
            $return = true;

            if ($this->min_amount > 0 && $cent < $this->min_amount) {
                $return = false;
            }

            if ($this->max_amount > 0 && $cent > $this->max_amount) {
                $return = false;
            }

            return $return;
        }

        public function isAvailableForProduct($product)
        {
            if ($product != null) {
                $return = true;

                if ($this->min_amount > 0 && $product->price_in_cent < $this->min_amount) {
                    $return = false;
                }

                if ($this->max_amount > 0 && $product->price_in_cent > $this->max_amount) {
                    $return = false;
                }

                return $return;
            }
        }

        public function getFormattedMinAmount()
        {
            return $this->getFormattedMinAmountWithoutCurrency().' '.Setting::getShopCurrency();
        }

        public function getFormattedMinAmountWithoutCurrency()
        {
            return number_format($this->min_amount / 100, 2, ',', '.');
        }

        public function getFormattedMaxAmount()
        {
            return $this->getFormattedMaxAmountWithoutCurrency().' '.Setting::getShopCurrency();
        }

        public function getFormattedMaxAmountWithoutCurrency()
        {
            return number_format($this->max_amount / 100, 2, ',', '.');
        }

        public function getFormattedPrice()
        {
            return $this->getFormattedPriceWithoutCurrency().' '.Setting::getShopCurrency();
        }

        public function getFormattedPriceWithoutCurrency()
        {
            return number_format($this->price / 100, 2, ',', '.');
        }
    }
