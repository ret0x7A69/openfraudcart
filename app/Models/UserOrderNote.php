<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserOrderNote extends Model
    {
        protected $table = 'users_orders_notes';

        protected $fillable = [
            'order_id', 'note',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public function getDateTime()
        {
            return $this->created_at->format('d.m.Y H:i');
        }
    }
