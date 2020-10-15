<?php

    return [

        'admin_panel' => 'Admin Panel',

        'to_much_tickets_error' => 'Du kannst maximal :amount offene Tickets haben.',
        'not_allowed_to_open_ticket' => 'Nur User die Einzahlungen oder Bestellungen getätigt haben können Tickets eröffnen.',

        'login' => [
            'title' => 'Sign in',
            'submit' => 'Sign in',
            'forgot_password' => 'Forgot password?',
            'remember' => 'Remember me',
            'password' => 'Password',
            'confirm_password' => 'Password',
            'create_account' => 'Sign up',
        ],

        'register' => [
            'title' => 'Sign up',
            'submit' => 'Sign up',
            'password' => 'Password',
            'confirm_password' => 'Confirm password',
            'cancel' => 'Cancel',
            'newsletter_enabled' => 'Subscribe our newsletter',
        ],

        'reset' => [
            'password' => [
                'title' => 'Reset password',
                'submit' => 'Reset',
                'password' => 'Password',
                'confirm_password' => 'Confirm password',
            ],
        ],

        'verify' => [
            'title' => 'Confirm email address',
            'alerts' => [
                'sent' => 'A new confirmation link has been sent to your email address.',
            ],
            'messages' => [
                'before_proceeding' => 'Before proceeding, please check your email for a confirmation link.',
                'not_received_email' => 'If you have not received an e-mail, <a href=":url">click here</a>.',
            ],
        ],

        'panel' => [
            'welcome_message' => 'Welcome, <b>:name</b>.',
            'member_since' => 'You re registered since <b>:date</b>!',
        ],

        'orders_page' => [
            'no_orders_exists' => 'You have not ordered anything yet.',
        ],

        'coupon_redeem' => [
            'title' => 'Redeem coupon',
            'code' => 'Coupon code:',
            'submit' => 'Redeem',
            'error1' => 'Invalid coupon code.',
            'error2' => 'Gutschein kann nicht mehr eingelöst werden.',
            'error3' => 'Du hast den Gutschein bereits eingelöst.',
            'error4' => 'Prozentuale Gutscheine sind nur beim Einkaufen einlösbar.',
            'success' => 'Du hast den Gutscheincode <b>:code</b> im Wert von <b>:amount</b> eingelöst.',
        ],

        'transactions_page' => [
            'no_transactions_exists' => 'No transactions exists.',
            'confirmed' => 'Confirmed',
            'confirmations' => ':confirms/:confirms_needed confirmations',
            'waiting' => 'Payment waiting',
            'actions' => 'Actions',
            'txid' => 'TXID',
            'status' => 'Status',
            'wallet' => 'Wallet',
            'amount' => 'Amount',
            'date' => 'Date',
            'id' => 'ID',
        ],

        'tickets' => [
            'list_tickets' => 'Tickets',
            'no_tickets_exists' => 'You have not created any tickets yet.',
            'status' => 'Status',
            'category' => 'Category',
            'date' => 'Date',
            'actions' => 'Actions',
            'subject' => 'Subject',
            'no_category' => 'No category',
            'view' => 'View',
            'delete' => 'Delete',
            'id' => 'ID',
            'ticket_details' => 'Ticket-Details',
            'message' => 'Message',
            'reply_button' => 'Reply',
            'all_fields_required' => 'All fields are required.',
            'message_to_long' => 'Your message is too long (max :chars characters).',
            'ticket_create' => 'Create ticket',
            'create_button' => 'Create',
            'reply_title' => 'Reply',
            'status_data' => [
                'open' => 'Open',
                'closed' => 'Closed',
                'replied' => 'Replied',
            ],
        ],

        'profile' => 'Account',
        'deposit' => 'Deposit',
        'transactions' => 'Transactions',
        'orders' => 'My orders',
        'payment_methods' => 'Payment methods',
        'transactions_history' => 'Transactions',

        'date' => 'Date:',

        'settings' => 'Settings',

        'success_password_changed' => 'Password successfully changed.',
        'settings_current_password_wrong' => 'The current password is wrong.',
        'settings_change_password' => 'Change password',
        'settings_current_password' => 'Current password',
        'settings_new_password' => 'New password',
        'settings_new_password_confirm' => 'Confirm new password',

        'settings_newsletter_enabled' => 'Subscribe our newsletter',
        'settings_change_jabber_id' => 'Change Jabber-ID',
        'settings_jabber_id' => 'Jabber-ID',

        'settings_change_mail_address' => 'Change E-Mail address',
        'settings_mail_address' => 'E-Mail addresse',

        'settings_save_submit' => 'Update',

        'logout' => 'Sign out',

        'name' => 'Public name',
        'username' => 'Username',
        'email' => 'E-Mail address',
        'jabber_id' => 'Jabber-ID',
        'email_or_username' => 'E-Mail address / username',

        'cashin_btc_button' => 'Pay with Bitcoin',
        'cashin_eth_button' => 'Pay with ETH',

        'btc_cashin_title' => 'Pay with Bitcoin',
        'btc_cashin_info' => 'Wallet:',
        'wallet_copied' => 'Wallet copied!',
        'copy' => 'Copy',
        'open_in_wallet' => 'Open in wallet',
        'i_paid_button' => 'I have paid!',
        'check_again' => 'Check again',
    ];
