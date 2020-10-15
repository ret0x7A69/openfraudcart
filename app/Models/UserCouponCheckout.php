<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserCouponCheckout extends Model
    {
        protected $table = 'users_coupons_checkouts';

        protected $fillable = [
            'user_id', 'coupon_code',
        ];
    }
