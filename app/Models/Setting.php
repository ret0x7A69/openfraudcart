<?php

namespace App\Models;

    use Config;
    use Illuminate\Database\Eloquent\Model;

    class Setting extends Model
    {
        protected $table = 'settings';

        protected $fillable = [
            'key', 'value', 'type',
        ];

        public static function getShopCurrency()
        {
            $currency = strtoupper(self::get('shop.currency', 'EUR'));

            return $currency;
        }

        public static function getAvailableLocales()
        {
            $locales = [];
            $string = strtolower(self::get('app.available.locales', ''));

            if (strlen($string) > 0) {
                $locales = explode(',', $string);
            }

            return $locales;
        }

        public static function getLocale()
        {
            return strtolower(self::get('app.locale', ''));
        }

        public static function set($key, $value)
        {
            // Exists Check
            if (! self::where('key', $key)->exists()) {
                return false;
            }

            if (self::where('key', $key)->first()->update([
                'value' => $value,
            ])) {
                return true;
            }
        }

        public static function get($key, $default = null)
        {
            // Exists Check
            if (! self::where('key', $key)->exists()) {
                return $default;
            }

            // Define Variable
            $setting = self::where('key', $key)->first();

            // Before
            if (! empty($setting->before_add)) {
                switch ($setting->before_add) {
                    case 'url':
                        $beforeValue = url('/');
                        break;
                    default:
                        if (self::where('key', $setting->before_add)->exists()) {
                            $before = self::where('key', $setting->before_add)->first();
                            $beforeValue = $before->value;
                        }

                        break;
                }
            }

            // After
            if (! empty($setting->after_add)) {
                switch ($setting->after_add) {
                    case 'url':
                        $afterValue = url('/');
                        break;
                    default:
                        if (self::where('key', $setting->after_add)->exists()) {
                            $after = self::where('key', $setting->after_add)->first();
                            $afterValue = $after->value;
                        }

                        break;
                }
            }

            $type = strtolower($setting->type);

            if ($type == 'bool' || $type == 'boolean') {
                return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
            } elseif ($type == 'int' || $type == 'integer') {
                return intval($setting->value);
            }

            $value = ($beforeValue ?? '').$setting->value.($afterValue ?? '');

            return $value;
        }
    }
