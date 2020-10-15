<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Bonus extends Model
    {
        protected $table = 'bonus_settings';

        protected $fillable = [
            'percent', 'min_amount',
        ];
    }
