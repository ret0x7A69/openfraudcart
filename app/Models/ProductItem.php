<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ProductItem extends Model
    {
        protected $table = 'products_items';

        protected $fillable = [
            'content', 'product_id',
        ];

        protected $hidden = [
            'content',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }
    }
