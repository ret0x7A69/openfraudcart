<?php

namespace App\Models;

    use App\Models\FAQ;
    use Illuminate\Database\Eloquent\Model;

    class FAQCategory extends Model
    {
        protected $table = 'faqs_categories';

        protected $fillable = [
            'name',
        ];

        public function getEntries()
        {
            $faqs = FAQ::where('category_id', $this->id)->orderBy('ordering')->get();

            return $faqs;
        }
    }
