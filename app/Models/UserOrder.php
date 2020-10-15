<?php

namespace App\Models;

    use App\Models\Setting;
    use App\Models\User;
    use App\Models\UserOrderNote;
    use DB;
    use Illuminate\Database\Eloquent\Model;

    class UserOrder extends Model
    {
        protected $table = 'users_orders';

        protected $fillable = [
            'user_id', 'name', 'content', 'price_in_cent', 'amount', 'status', 'weight', 'weight_char', 'totalprice', 'drop_info', 'delivery_method', 'delivery_price',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public static function getTodayWin()
        {
            $todayOrders = self::whereDate('created_at', DB::raw('CURDATE()'))->get();

            $cent = 0;

            foreach ($todayOrders as $order) {
                $cent += $order->price_in_cent;
            }

            return $cent;
        }

        public static function getFormattedTodayWin()
        {
            return number_format(self::getTodayWin() / 100, 2, ',', '.').' '.Setting::getShopCurrency();
        }

        public function getAmount()
        {
            return $this->amount;
        }

        public function hasNotes()
        {
            return UserOrderNote::where('order_id', $this->id)->count() > 0;
        }

        public function getNotes()
        {
            return UserOrderNote::orderByDesc('created_at')->where('order_id', $this->id)->get();
        }

        public function isShopping()
        {
            $userCartEntry = UserCartEntry::where('order_id', $this->id)->get()->first();

            return $userCartEntry != null;
        }

        public function getShoppingId()
        {
            if ($this->isShopping()) {
                $userCartEntry = UserCartEntry::where('order_id', $this->id)->get()->first();

                if ($userCartEntry != null) {
                    return $userCartEntry->shopping_id;
                }
            }

            return 0;
        }

        public function getDrop()
        {
            return $this->drop_info;
        }

        public function getWeight()
        {
            return $this->weight;
        }

        public function getWeightChar()
        {
            return $this->weight_char;
        }

        public function asWeight()
        {
            return strlen($this->weight_char) > 0 && intval($this->weight) > 0;
        }

        public function getStatus()
        {
            return strlen($this->status) > 0 ? strtolower($this->status) : 'nothing';
        }

        public function getUser()
        {
            $name = '-/-';

            $user = User::where('id', $this->user_id)->get()->first();

            if ($user != null) {
                $name = $user->username;
            }

            return (object) [
                'name' => $name,
                'username' => $name,
            ];
        }

        public function getFormattedDeliveryPrice()
        {
            return $this->getFormattedDeliveryPriceWithoutCurrency().' '.Setting::getShopCurrency();
        }

        public function getFormattedDeliveryPriceWithoutCurrency()
        {
            return number_format($this->delivery_price / 100, 2, ',', '.');
        }

        public function getFormattedTotalPrice()
        {
            return number_format($this->totalprice / 100, 2, ',', '.').' '.Setting::getShopCurrency();
        }

        public function getFormattedPrice()
        {
            $after = '';

            if ($this->asWeight()) {
                $after = '/'.$this->getWeightChar();
            }

            return number_format($this->price_in_cent / 100, 2, ',', '.').' '.Setting::getShopCurrency().$after;
        }
    }
