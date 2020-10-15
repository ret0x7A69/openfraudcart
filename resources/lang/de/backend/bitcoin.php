<?php

    return [

        'title' => 'Bitcoin Verwaltung',

        'balance' => 'Kontostand',

        'connection_error' => 'Es konnte keine Verbindung zur Node hergestellt werden. Bitte <a href=":url" class="alert-link">klicken Sie hier</a> um die Einstellungen vorzunehmen.',

        'generateaddress' => [
            'title' => 'Empfangen',
            'regenerate' => 'Neue Wallet generieren',
        ],

        'transactions' => [
            'title' => 'Transaktionen',
            'no_entries' => 'Keine Transaktionen vorhanden.',

            'category' => '#',
            'user' => 'Benutzer',
            'txid' => 'TXID',
            'status' => 'Status',
            'wallet' => 'Wallet',
            'amount' => 'Betrag',
            'date' => 'Datum',
            'id' => 'ID',

            'confirmed' => 'Bestätigt',
            'confirmations' => ':confirms/:confirms_needed Bestätigungen',
            'waiting' => 'Zahlung ausstehend',
        ],

        'primarywallet' => [
            'title' => 'Primäre Wallet festlegen',
            'walletaddress' => 'BTC Adresse',
            'submit_button' => 'Speichern',
            'info' => 'Bitcoins werden ab einem Kontostand von <b>0.00500 BTC</b> an die primäre Wallet weitergeleitet.',
            'unknown_error' => 'Es ist ein unbekannter Fehler aufgetreten.',
            'successfully' => 'Bitcoin Adresse <b>:address</b> wurde als primäre Wallet festgelegt.',
            'successfully2' => 'Primäre Wallet wurde entfernt.',
        ],

        'sendbtc' => [
            'title' => 'Senden',
            'walletaddress' => 'BTC Adresse',
            'submit_button' => 'Überweisen',
            'amount' => 'Betrag',
            'fee' => 'Gebühr',
            'fee_info' => '<b>Vorgeschlagen:</b> :btc BTC / Satoshi: :satoshi',
            'unknown_error' => 'Es ist ein unbekannter Fehler aufgetreten.',
            'successfully' => '<b>:amount</b> an die Adresse <b>:address</b> gesendet.',
        ],

    ];
