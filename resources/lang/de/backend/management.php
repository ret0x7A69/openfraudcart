<?php

    return [

        'title' => 'Verwaltung',

        'products' => [
            'title' => 'Produkte',

            'unlimited' => 'Unbegrenzt',
            'sold_out' => 'Ausverkauft',

            'show_product' => 'Produkt anzeigen',

            'weight' => 'Gewicht',
            'weightchar' => 'Gewicht Bezeichnung (G, L, KG, ...)',
            'weight_available' => ':weight:char',

            'add' => [
                'title' => 'Produkt erstellen',
                'submit_button' => 'Erstellen',
                'options' => 'Optionen',
                'drop_needed' => 'Drop-Funktion aktivieren',
                'unlimited_available' => 'Unbegrenzt verfügbar',
                'normal_stock_management' => 'Lagerverwaltung aktivieren',
                'as_weight' => 'Gewicht (Gramm, Kilo, Liter, ...)',
            ],

            'edit' => [
                'title' => 'Produkt bearbeiten',
                'submit_button' => 'Bearbeiten',
                'database' => 'Datenbank-Verwaltung',
                'options' => 'Optionen',
                'drop_needed' => 'Drop-Funktion aktivieren',
                'unlimited_available' => 'Unbegrenzt verfügbar',
                'normal_stock_management' => 'Lagerverwaltung aktivieren',
                'as_weight' => 'Gewicht (Gramm, Kilo, Liter, ...)',
            ],

            'database' => [
                'title' => 'Datenbank',
                'title2' => 'Datenbank (:count)',

                'widget1' => [
                    'title' => 'Datensätze',
                ],

                'import' => [
                    'successfully' => ':count Datensätze importiert.',
                    'one_successfully' => 'Datensatz importiert.',

                    'options' => 'Optionen',
                    'line_by_line' => 'Zeile für Zeile',
                    'with_seperator' => 'Trennzeichen:',

                    'txt' => [
                        'seperator_required' => 'Trennzeichen ist erforderlich.',
                        'title' => 'Input-Import',
                        'input' => 'Input',
                    ],

                    'one' => [
                        'title' => 'One-Import',
                        'content' => 'Inhalt',
                    ],

                    'submit_button' => 'Importieren',
                ],
            ],

            'categories' => [
                'title' => 'Kategorien',

                'add' => [
                    'title' => 'Kategorie hinzufügen',
                    'submit_button' => 'Hinzufügen',
                ],

                'edit' => [
                    'title' => 'Kategorie bearbeiten',
                    'submit_button' => 'Bearbeiten',
                ],

                'id' => 'ID',
                'name' => 'Bezeichnung',
                'slug' => 'Slug',
                'keywords' => 'Keywords',
                'meta_tags_desc' => 'META Description',
                'actions' => 'Aktionen',
            ],

            'id' => 'ID',
            'name' => 'Produkt',
            'content' => 'Inhalt',
            'description' => 'Beschreibung',
            'short_description' => 'Kurzbeschreibung',
            'stock_management' => 'Lagerverwaltung',
            'price' => 'Preis',
            'price_in_cent' => 'Preis ohne Kommastellen',
            'price_in_cent_example' => '100 (entspricht 1,00€)',
            'old_price' => 'Regulärer Preis',
            'old_price_in_cent' => 'Regulärer Preis ohne Kommastellen (OPTIONAL)',
            'old_price_in_cent_example' => '100 (entspricht 1,00€)',
            'category' => 'Kategorie',
            'stock_status' => 'Lagerbestand',
            'sells' => 'Verkäufe',
            'actions' => 'Aktionen',
        ],

        'faqs' => [
            'title' => 'Häufige Fragen',

            'categories' => [
                'title' => 'Kategorien',

                'add' => [
                    'title' => 'Kategorie hinzufügen',
                    'submit_button' => 'Hinzufügen',
                ],

                'edit' => [
                    'title' => 'Kategorie bearbeiten',
                    'submit_button' => 'Bearbeiten',
                ],

                'id' => 'ID',
                'name' => 'Bezeichnung',
                'actions' => 'Aktionen',
            ],

            'add' => [
                'title' => 'Beitrag verfassen',
                'submit_button' => 'Erstellen',
            ],

            'edit' => [
                'title' => 'Beitrag bearbeiten',
                'submit_button' => 'Bearbeiten',
            ],

            'id' => 'ID',
            'question' => 'Frage',
            'answer' => 'Antwort',
            'category' => 'Kategorie',
            'actions' => 'Aktionen',
        ],

        'users' => [
            'title' => 'Benutzer',

            'edit' => [
                'title' => 'Benutzer bearbeiten',
                'submit_button' => 'Bearbeiten',
                'save_button' => 'Speichern',

                'permissions' => [
                    'title' => 'Zugriffsrechte bearbeiten',
                ],
            ],

            'widget1' => [
                'title' => 'Transaktionen',
            ],

            'widget2' => [
                'title' => 'Tickets',
            ],

            'widget3' => [
                'title' => 'Bestellungen',
            ],

            'widget4' => [
                'title' => 'Permissions',
            ],

            'id' => 'ID',
            'name' => 'Anzeigename',
            'username' => 'Benutzername',
            'jabber' => 'Jabber-ID',
            'newsletter_enabled' => 'Newsletter',
            'balance' => 'Guthaben',
            'balance_in_cent' => 'Guthaben in Cent',
            'enabled' => 'Aktiviert',
            'disabled' => 'Deaktiviert',
            'date' => 'Datum',
            'actions' => 'Aktionen',
        ],

        'coupons' => [
            'title' => 'Gutscheine',

            'add' => [
                'title' => 'Gutschein hinzufügen',
                'submit_button' => 'Hinzufügen',
                'unlimited' => 'Unbegrenzt verfügbar (pro Nutzer nur einmal)',
                'options' => 'Optionen',
            ],

            'edit' => [
                'title' => 'Gutschein bearbeiten',
                'submit_button' => 'Bearbeiten',
                'unlimited' => 'Unbegrenzt verfügbar (pro Nutzer nur einmal)',
                'options' => 'Optionen',
            ],

            'id' => 'ID',
            'code' => 'Code',
            'usage' => 'Verfügbarkeit',
            'amount' => 'Betrag',
            'date' => 'Datum',
            'max_usable' => 'Maximale Verfügbarkeit (-1 unbegrenzt, für jeden User einmal)',
            'actions' => 'Aktionen',
        ],

        'delivery_methods' => [
            'title' => 'Versandarten',

            'add' => [
                'title' => 'Versandart hinzufügen',
                'submit_button' => 'Hinzufügen',
                'options' => 'Optionen',
            ],

            'edit' => [
                'title' => 'Versandart bearbeiten',
                'submit_button' => 'Bearbeiten',
                'options' => 'Optionen',
            ],

            'id' => 'ID',
            'name' => 'Bezeichnung',
            'price' => 'Preis',
            'min_amount' => 'Mindestbestellwert in Cent',
            'max_amount' => 'Höchstbestellwert in Cent (0 = nicht festgelegt)',
            'date' => 'Datum',
            'actions' => 'Aktionen',
        ],

        'articles' => [
            'title' => 'Neuigkeiten',

            'add' => [
                'title' => 'Beitrag verfassen',
                'submit_button' => 'Erstellen',
                'anonym' => 'Verfasser verbergen (Anonym)',
                'options' => 'Optionen',
            ],

            'edit' => [
                'title' => 'Beitrag bearbeiten',
                'submit_button' => 'Bearbeiten',
                'anonym' => 'Verfasser verbergen (Anonym)',
                'options' => 'Optionen',
            ],

            'id' => 'ID',
            'article_title' => 'Titel',
            'content' => 'Inhalt',
            'date' => 'Datum',
            'author' => 'Verfasser',
            'actions' => 'Aktionen',
        ],

        'tickets' => [
            'title' => 'Tickets',

            'edit' => [
                'title' => 'Ticket bearbeiten',
                'submit_button' => 'Bearbeiten',
                'subject' => 'Betreff:',
                'category' => 'Kategorie:',
                'message' => 'Nachricht',
                'move_category' => 'Kategorie verschieben',
                'title_reply' => 'Antwort verfassen',
                'close' => 'Schließen',
                'open' => 'Freigeben',
                'move' => 'Verschieben',
                'submit_button' => 'Senden',
            ],

            'categories' => [
                'title' => 'Kategorien',

                'add' => [
                    'title' => 'Kategorie hinzufügen',
                    'submit_button' => 'Hinzufügen',
                ],

                'edit' => [
                    'title' => 'Kategorie bearbeiten',
                    'submit_button' => 'Bearbeiten',
                ],

                'id' => 'ID',
                'name' => 'Bezeichnung',
                'actions' => 'Aktionen',
            ],

            'status_data' => [
                'open' => 'Offen',
                'closed' => 'Geschlossen',
                'replied' => 'Beantwortet',
            ],

            'id' => 'ID',
            'subject' => 'Betreff',
            'category' => 'Kategorie',
            'status' => 'Status',
            'user' => 'Benutzer',
            'date' => 'Datum',
            'actions' => 'Aktionen',
        ],

    ];
