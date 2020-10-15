<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserCartEntry extends Model
    {
        protected $table = 'users_carts_entries';

        protected $fillable = [
            'user_id', 'order_id', 'shopping_id',
        ];
    }
