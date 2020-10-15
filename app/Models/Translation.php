<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Translation extends Model
    {
        protected $table = 'translations';

        protected $fillable = [
            'entry_id', 'value', 'type', 'lang', 'keyword',
        ];
    }
