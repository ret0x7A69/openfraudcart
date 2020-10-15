<?php

namespace App\Models;

    use App\Models\Product;
    use Illuminate\Database\Eloquent\Model;

    class ProductCategory extends Model
    {
        protected $table = 'products_categories';

        protected $fillable = [
            'name', 'slug', 'keywords', 'meta_tags_desc',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public function getProducts()
        {
            $products = Product::where('category_id', $this->id)->get();

            return $products;
        }
    }
