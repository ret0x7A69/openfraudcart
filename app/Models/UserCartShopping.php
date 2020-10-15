<?php

namespace App\Models;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Model;

    class UserCartShopping extends Model
    {
        protected $table = 'users_carts_shoppings';

        protected $fillable = [
            'user_id', 'is_done',
        ];

        public function getUser()
        {
            $user = User::where('id', $this->user_id)->get()->first();

            if ($user != null) {
                return $user;
            }

            return (object) [
                'name' => 'n/A',
            ];
        }

        public function isDone()
        {
            return $this->is_done == 1;
        }

        public function done()
        {
            $this->update([
                'is_done' => 1,
            ]);
        }

        public function getOrders()
        {
            $orders = [];

            foreach (UserCartEntry::where('shopping_id', $this->id)->get() as $cartEntry) {
                $order = UserOrder::where('id', $cartEntry->order_id)->get()->first();

                if ($order != null) {
                    $orders[] = $order;
                }
            }

            return $orders;
        }
    }
