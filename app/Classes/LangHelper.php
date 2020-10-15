<?php

namespace App\Classes;

    use App\Models\Setting;
    use App\Models\Translation;

    class LangHelper
    {
        public static function translate($lang, $type, $keyword, $col, $obj, $decrypt = false)
        {
            $val = self::getValue($lang, $type, $keyword, $obj->id);

            if ($val != null) {
                return $val;
            }

            if ($decrypt) {
                return strlen($obj->{$col}) > 0 ? decrypt(nl2br($obj->{$col})) : '';
            }

            return $obj->{$col};
        }

        public static function getValue($lang, $type, $keyword, $id)
        {
            $translation = Translation::where([
                ['lang', '=', $lang],
                ['type', '=', $type],
                ['keyword', '=', $keyword],
                ['entry_id', '=', $id],
            ])->get()->first();

            if ($translation != null) {
                return $translation->value;
            }

            return null;
        }

        public static function getLangSelector($route = '', $id = 0, $lang = null)
        {
            if (count(Setting::getAvailableLocales())) {
                echo '<hr/>';

                if ($lang != null) {
                }

                foreach (Setting::getAvailableLocales() as $locale) {
                    $default = false;
                    if (strtolower($locale) == strtolower(Setting::get('app.locale'))) {
                        $default = true;
                    }

                    $name = \Lang::get('locale.name', [], $locale);
                    $flag = '<img class="flag-icon-img" style="width:20px;border-radius:50%;padding-right:2px" src="'.asset_dir('svg/flags/'.\Lang::get('locale.icon', [], $locale).'.svg').'" />';

                    if (! $default) {
                        $url = '#';

                        if (strlen($route)) {
                            $l = strtolower($locale);

                            switch ($route) {
                                case 'lang-edit-product':
                                    $url = '/admin/management/products/lang/'.$l.'/edit/'.$id;
                                    break;
                                case 'lang-edit-product-category':
                                    $url = '/admin/management/products/categories/lang/'.$l.'/edit/'.$id;
                                    break;
                                case 'lang-edit-faq-category':
                                    $url = '/admin/management/faqs/categories/lang/'.$l.'/edit/'.$id;
                                    break;
                                case 'lang-edit-faq':
                                    $url = '/admin/management/faq/lang/'.$l.'/edit/'.$id;
                                    break;
                                case 'lang-edit-ticket-category':
                                    $url = '/admin/management/tickets/category/lang/'.$l.'/edit/'.$id;
                                    break;
                                case 'lang-edit-article':
                                    $url = '/admin/management/article/lang/'.$l.'/edit/'.$id;
                                    break;
                            }

                            //$route = route($route, [strtolower($locale), $id]);
                        }

                        echo '<a href="'.$url.'" style="margin-right:2px !important;margin-bottom:5px" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">'.$flag.' '.$name.' <i class="fas fa-edit"></i></a>';
                    }
                }
            }
        }
    }
