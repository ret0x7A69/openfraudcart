<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserTicketCategory extends Model
    {
        protected $table = 'users_tickets_categories';

        protected $fillable = [
            'name',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }
    }
