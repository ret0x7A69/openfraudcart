<?php

    return [

        'accepted' => 'The :attribute must be accepted.',
        'active_url' => 'The :attribute is not a valid URL.',
        'after' => 'The :attribute must be a date after :date.',
        'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
        'alpha' => 'The :attribute may only contain letters.',
        'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
        'alpha_num' => 'The :attribute may only contain letters and numbers.',
        'array' => 'The :attribute must be an array.',
        'before' => 'The :attribute must be a date before :date.',
        'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
        'between' => [
            'numeric' => 'The :attribute must be between :min and :max.',
            'file' => 'The :attribute must be between :min and :max kilobytes.',
            'string' => 'The :attribute must be between :min and :max characters.',
            'array' => 'The :attribute must have between :min and :max items.',
        ],
        'boolean' => ':attribute ist ungültig.',
        'confirmed' => 'The :attribute confirmation does not match.',
        'date' => 'The :attribute is not a valid date.',
        'date_equals' => 'The :attribute must be a date equal to :date.',
        'date_format' => 'The :attribute does not match the format :format.',
        'different' => 'The :attribute and :other must be different.',
        'digits' => 'The :attribute must be :digits digits.',
        'digits_between' => 'The :attribute must be between :min and :max digits.',
        'dimensions' => 'The :attribute has invalid image dimensions.',
        'distinct' => 'The :attribute field has a duplicate value.',
        'email' => ':attribute ungültig.',
        'exists' => 'The selected :attribute is invalid.',
        'file' => 'The :attribute must be a file.',
        'filled' => 'The :attribute field must have a value.',
        'gt' => [
            'numeric' => 'The :attribute must be greater than :value.',
            'file' => 'The :attribute must be greater than :value kilobytes.',
            'string' => 'The :attribute must be greater than :value characters.',
            'array' => 'The :attribute must have more than :value items.',
        ],
        'gte' => [
            'numeric' => 'The :attribute must be greater than or equal :value.',
            'file' => 'The :attribute must be greater than or equal :value kilobytes.',
            'string' => 'The :attribute must be greater than or equal :value characters.',
            'array' => 'The :attribute must have :value items or more.',
        ],
        'image' => 'The :attribute must be an image.',
        'in' => 'The selected :attribute is invalid.',
        'in_array' => 'The :attribute field does not exist in :other.',
        'integer' => ':attribute ist ungültig.',
        'ip' => 'The :attribute must be a valid IP address.',
        'ipv4' => 'The :attribute must be a valid IPv4 address.',
        'ipv6' => 'The :attribute must be a valid IPv6 address.',
        'json' => 'The :attribute must be a valid JSON string.',
        'lt' => [
            'numeric' => 'The :attribute must be less than :value.',
            'file' => 'The :attribute must be less than :value kilobytes.',
            'string' => 'The :attribute must be less than :value characters.',
            'array' => 'The :attribute must have less than :value items.',
        ],
        'lte' => [
            'numeric' => 'The :attribute must be less than or equal :value.',
            'file' => 'The :attribute must be less than or equal :value kilobytes.',
            'string' => 'The :attribute must be less than or equal :value characters.',
            'array' => 'The :attribute must not have more than :value items.',
        ],
        'max' => [
            'numeric' => ':attribute darf nicht größer sein als :max.',
            'file' => 'The :attribute may not be greater than :max kilobytes.',
            'string' => ':attribute darf nicht länger sein als :max Zeichen.',
            'array' => 'The :attribute may not have more than :max items.',
        ],
        'mimes' => 'The :attribute must be a file of type: :values.',
        'mimetypes' => 'The :attribute must be a file of type: :values.',
        'min' => [
            'numeric' => 'The :attribute must be at least :min.',
            'file' => 'The :attribute must be at least :min kilobytes.',
            'string' => ':attribute muss mindestens :min Zeichen lang sein.',
            'array' => 'The :attribute must have at least :min items.',
        ],
        'not_in' => 'The selected :attribute is invalid.',
        'not_regex' => 'The :attribute format is invalid.',
        'numeric' => 'The :attribute must be a number.',
        'present' => 'The :attribute field must be present.',
        'regex' => 'The :attribute format is invalid.',
        'required' => ':attribute ist erforderlich.',
        'required_if' => 'The :attribute field is required when :other is :value.',
        'required_unless' => 'The :attribute field is required unless :other is in :values.',
        'required_with' => 'The :attribute field is required when :values is present.',
        'required_with_all' => 'The :attribute field is required when :values are present.',
        'required_without' => 'The :attribute field is required when :values is not present.',
        'required_without_all' => 'The :attribute field is required when none of :values are present.',
        'same' => ':attribute muss identisch sein mit :other.',
        'size' => [
            'numeric' => 'The :attribute must be :size.',
            'file' => 'The :attribute must be :size kilobytes.',
            'string' => 'The :attribute must be :size characters.',
            'array' => 'The :attribute must contain :size items.',
        ],
        'string' => 'The :attribute must be a string.',
        'timezone' => 'The :attribute must be a valid zone.',
        'unique' => ':attribute ist bereits registriert.',
        'uploaded' => 'The :attribute failed to upload.',
        'url' => 'The :attribute format is invalid.',
        'uuid' => 'The :attribute must be a valid UUID.',

        'custom' => [
            'attribute-name' => [
                'rule-name' => 'custom-message',
            ],
        ],

        'attributes' => [
            'message' => 'Nachricht',

            'settings_jabber_id' => 'Jabber-ID',
            'settings_mail_address' => 'E-Mail Adresse',
            'settings_new_password' => 'Neues Passwort',
            'settings_new_password_confirm' => 'Passwort-Wiederholung',
            'settings_current_password' => 'Aktuelles Passwort',
            'settings_app_name' => 'App Name',
            'settings_shop_currency' => 'Shop Währung',
            'settings_access_only_for_users' => 'Feld',

            'article_add_title' => 'Titel',
            'article_add_content' => 'Inhalt',
            'article_edit_content' => 'Inhalt',
            'article_edit_title' => 'Titel',

            'faq_edit_ordering' => 'Reihenfolge',
            'faq_add_ordering' => 'Reihenfolge',
            'faq_add_question' => 'Frage',
            'faq_add_answer' => 'Antwort',
            'faq_add_category' => 'Kategorie',
            'faq_edit_question' => 'Frage',
            'faq_edit_answer' => 'Antwort',
            'faq_edit_category' => 'Kategorie',

            'faq_category_add_name' => 'Bezeichnung',
            'faq_category_edit_name' => 'Bezeichnung',

            'product_category_add_name' => 'Bezeichnung',
            'product_category_edit_name' => 'Bezeichnung',
            'product_category_add_slug' => 'Slug',
            'product_category_edit_slug' => 'Slug',

            'product_add_name' => 'Bezeichnung',
            'product_add_content' => 'Inhalt',
            'product_add_description' => 'Beschreibung',
            'product_add_short_description' => 'Kurzbeschreibung',
            'product_add_category_id' => 'Kategorie',
            'product_add_price_in_cent' => 'Preis',
            'product_add_old_price_in_cent' => 'Regulärer Preis',
            'product_add_interval' => 'Interval',

            'product_edit_name' => 'Bezeichnung',
            'product_edit_content' => 'Inhalt',
            'product_edit_description' => 'Beschreibung',
            'product_edit_short_description' => 'Kurzbeschreibung',
            'product_edit_category_id' => 'Kategorie',
            'product_edit_price_in_cent' => 'Preis',
            'product_edit_old_price_in_cent' => 'Regulärer Preis',
            'product_edit_interval' => 'Interval',

            'bitcoin_sendbtc_amount' => 'Betrag',
            'bitcoin_sendbtc_address' => 'Adresse',
            'bitcoin_sendbtc_fee' => 'Gebühr',

            'jabber_message' => 'Nachricht',

            'ticket_reply_msg' => 'Nachricht',

            'ticket_category_add_name' => 'Bezeichnung',
            'ticket_category_edit_name' => 'Bezeichnung',

            'import_txt_input' => 'Input',
            'import_one_content' => 'Inhalt',
            'product_import_txt_seperator_input' => 'Trennzeichen',

            'user_edit_name' => 'Anzeigename',
            'user_edit_username' => 'Benutzername',
            'user_edit_jabber' => 'Jabber-ID',

            'bitcoin_primarywallet_address' => 'Adresse',

            'product_add_stock_management' => 'Lagerverwaltung',

            'settings_bonus_percent' => 'Bonus',

            'coupon_redeem_code' => 'Gutscheincode',

            'jabber_address' => 'Jabber Adresse',
            'jabber_username' => 'Benutzername',
            'jabber_password' => 'Passwort',

            'payments_bitcoin_api' => 'Bitcoin API Login',

            'settings_api_enabled' => 'API Status',
            'settings_api_key' => 'API Key',

            'delivery_method_edit_name' => 'Bezeichnung',
            'delivery_method_edit_price' => 'Betrag',

            'delivery_method_add_name' => 'Bezeichnung',
            'delivery_method_add_price' => 'Betrag',

            'coupon_add_max_usable' => 'Maximale Verfügbarkeit',
            'coupon_add_code' => 'Code',
            'coupon_add_amount' => 'Betrag',

            'coupon_edit_max_usable' => 'Maximale Verfügbarkeit',
            'coupon_edit_code' => 'Code',
            'coupon_edit_amount' => 'Betrag',

            'media_file' => 'Datei',

            'order_note' => 'Notiz',

            'delivery_method_edit_min_amount' => 'Mindestbestellwert',
            'delivery_method_edit_max_amount' => 'Mindestbestellwert',
            'delivery_method_add_min_amount' => 'Höchstbestellwert',
            'delivery_method_add_max_amount' => 'Höchstbestellwert',

            'product_category_add_keywords' => 'Keywords',
            'product_category_edit_keywords' => 'Keywords',
            'product_category_add_meta_tags_desc' => 'META-Tags',
            'product_category_edit_meta_tags_desc' => 'META-Tags',

            'app_locale' => 'Sprache',
            'productitem_content' => 'Inhalt',

        ],

        'captcha' => 'Captcha fehlerhaft.',

    ];
