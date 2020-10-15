<?php

namespace App\Models;

use App\Http\Notifications\ResetPasswordNotification;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\UserCoupon;
use App\Models\UserCouponCheckout;
use App\Models\UserTicket;
use App\Models\UserTransaction;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use HasFactory;
        use Notifiable;

        protected $table = 'users';

        protected $fillable = [
            'name', 'username', 'email', 'password', 'jabber_id', 'newsletter_enabled', 'balance_in_cent', 'language',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];

        public function getOpenTicketsCount()
        {
            return UserTicket::getOpenTicketsCountByUserId($this->id);
        }

        public function hasCouponUsed($coupon)
        {
            return UserCoupon::where([
                'user_id' => $this->id,
                'coupon_id' => $coupon != null ? $coupon->id : 0,
            ])->get()->first() != null;
        }

        public function hasOrders()
        {
            return UserOrder::where('user_id', $this->id)->count() > 0;
        }

        public function getCheckoutCoupons()
        {
            $coupons = UserCouponCheckout::where('user_id', $this->id)->get();
            $coupons2 = [];

            foreach ($coupons as $couponCheckout) {
                $coupon = Coupon::where('code', $couponCheckout->coupon_code)->get()->first();

                if ($coupon != null) {
                    $coupons2[] = $couponCheckout;
                } else {
                    $couponCheckout->delete();
                }
            }

            return $coupons2;
        }

        public function hasTransactions()
        {
            return UserTransaction::where('user_id', $this->user_id)->where('status', '!=', 'waiting')->count() > 0;
        }

        public function enabledNewsletter()
        {
            return $this->newsletter_enabled == 1;
        }

        public function redeemCoupon($coupon)
        {
            if ($coupon instanceof Coupon) {
                return $coupon->redeem($this);
            }

            return false;
        }

        public function hasAnyPermissionFromArray($permissions)
        {
            foreach ($permissions as $permission) {
                $userPermission = UserPermission::getUserPermission($this->id, $permission);

                if ($userPermission != null) {
                    return true;
                }
            }

            return false;
        }

        public function hasPermission($permission)
        {
            $userPermission = UserPermission::getUserPermission($this->id, $permission);

            if ($userPermission != null) {
                return true;
            }

            return false;
        }

        public function getFormattedBalance()
        {
            return number_format($this->balance_in_cent / 100, 2, ',', '.').' '.Setting::getShopCurrency();
        }

        public function sendPasswordResetNotification($token)
        {
            $this->notify(new ResetPasswordNotification($token));
        }
    }
