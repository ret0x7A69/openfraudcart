<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class ProductBonus extends Model
    {
        protected $table = 'products_bonus';

        protected $fillable = [
            'percent', 'min_amount', 'product_id',
        ];
    }
