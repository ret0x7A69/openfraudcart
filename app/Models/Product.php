<?php

namespace App\Models;

    use App\Models\ProductCategory;
    use App\Models\Setting;
    use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
        protected $table = 'products';

        protected $fillable = [
            'sells', 'name', 'description', 'interval', 'short_description', 'drop_needed', 'content', 'old_price_in_cent', 'price_in_cent', 'category_id', 'stock_management', 'as_weight', 'weight_available', 'weight_char',
        ];

        protected $hidden = [
            'content',
        ];

        public static function getById($id)
        {
            return self::where('id', $id)->first();
        }

        public static function getUncategorizedProducts()
        {
            $products_arr = [];

            $products = self::where('category_id', 0)->get();

            foreach ($products as $product) {
                $products_arr[] = $product->id;
            }

            foreach (self::all() as $product) {
                if (ProductCategory::getById($product->category_id) == null && ! in_array($product->id, $products_arr)) {
                    $products[] = $product;
                }
            }

            return $products;
        }

        public static function formatPrice($cent)
        {
            return number_format($cent / 100, 2, ',', '.').' '.Setting::getShopCurrency();
        }

        public function getWeightChar()
        {
            return $this->weight_char;
        }

        public function getInterval()
        {
            if (! $this->asWeight()) {
                return 1;
            }

            return $this->interval ?? 1;
        }

        public static function getFormattedPriceFromCentWithoutCurrency($cent)
        {
            return number_format($cent / 100, 2, ',', '.');
        }

        public static function getFormattedPriceFromCent($cent)
        {
            return self::getFormattedPriceFromCentWithoutCurrency($cent).' '.Setting::getShopCurrency();
        }

        public function getFormattedPrice()
        {
            $after = '';

            if ($this->asWeight()) {
                $after = '/'.$this->getWeightChar();
            }

            return $this->getFormattedPriceWithoutCurrency().' '.Setting::getShopCurrency().$after;
        }

        public function getFormattedPriceWithoutCurrency()
        {
            return number_format($this->price_in_cent / 100, 2, ',', '.');
        }

        public function getFormattedOldPrice()
        {
            $after = '';

            if ($this->asWeight()) {
                $after = '/'.$this->getWeightChar();
            }

            return $this->getFormattedOldPriceWithoutCurrency().' '.Setting::getShopCurrency().$after;
        }

        public function getFormattedOldPriceWithoutCurrency()
        {
            return number_format($this->old_price_in_cent / 100, 2, ',', '.');
        }

        public function getCategory()
        {
            $productCategory = ProductCategory::where('id', $this->category_id)->first();

            if ($productCategory != null) {
                return $productCategory;
            }

            return (object) [
                'id' => 0,
                'name' => __('frontend/shop.uncategorized'),
                'slug' => 'uncategorized',
            ];
        }

        public function dropNeeded()
        {
            return $this->drop_needed == 1;
        }

        public function asWeight()
        {
            return $this->as_weight == 1;
        }

        public function getWeightAvailable()
        {
            return $this->weight_available;
        }

        public function isAvailableAmount($amount)
        {
            if ($this->isAvailable()) {
                if ($this->asWeight() && $this->getWeightAvailable() >= $amount) {
                    return true;
                } elseif ($this->inStock() && $this->getStock() >= $amount) {
                    return true;
                } elseif ($this->isUnlimited()) {
                    return true;
                }
            }

            return false;
        }

        public function isAvailable()
        {
            if ($this->isUnlimited()) {
                return true;
            } elseif ($this->asWeight() && $this->getWeightAvailable() > 0) {
                return true;
            } elseif ($this->inStock()) {
                return true;
            }

            return false;
        }

        public function isUnlimited()
        {
            return $this->stock_management == 0 && ! $this->asWeight();
        }

        public function isSale()
        {
            return $this->old_price_in_cent != null && $this->old_price_in_cent > 0 && $this->old_price_in_cent > $this->price_in_cent;
        }

        public function getSalePercent()
        {
            if ($this->isSale()) {
                return round((($this->old_price_in_cent - $this->price_in_cent) * 100) / $this->old_price_in_cent);
            }

            return 0;
        }

        public function inStock()
        {
            return ($this->getStock() > 0 || $this->getStock() == -1) && ! $this->asWeight();
        }

        public function getSells()
        {
            return $this->sells;
        }

        public function getStock()
        {
            if ($this->stock_management <= 0) {
                return -1;
            }

            $stock = ProductItem::where('product_id', $this->id)->count();

            return $stock;
        }
    }
