<?php

    \URL::forceScheme('https');

    Route::get('/robots.txt', 'RobotsController@robots')->name('robots');
    Route::get('/sitemap', 'SitemapController@main')->name('sitemap');
    Route::get('/sitemap/products', 'SitemapController@products')->name('sitemap-products');
    Route::get('/sitemap/categories', 'SitemapController@categories')->name('sitemap-categories');
    Route::get('/sitemap/news', 'SitemapController@news')->name('sitemap-news');
    Route::get('/sitemap.xml', 'SitemapController@main')->name('sitemap-xml');

    /*
     * Error
     */

    Route::get('403', 'Error\ErrorController@forbidden');
    Route::get('404', 'Error\ErrorController@notFound');
    Route::get('500', 'Error\ErrorController@fatal');
    Route::get('503', 'Error\ErrorController@serviceUnavailable');
    Route::get('no-permissions', 'Error\ErrorController@noPermissions')->name('no-permissions');

    /*

    Route::get('/api/product/database/import', 'API\ProductDatabaseImportController@databaseImport')->name('api-product-database-import');
    Route::post('/api/product/database/import', 'API\ProductDatabaseImportController@databaseImport');

    Route::get('/api/product/database/lbl/import', 'API\ProductDatabaseImportController@databaseImportLineByLine')->name('api-product-database-line-by-line-import');
    Route::post('/api/product/database/lbl/import', 'API\ProductDatabaseImportController@databaseImportLineByLine');

    Route::get('/api/product/database/seperator/import', 'API\ProductDatabaseImportController@databaseImportSeperator')->name('api-product-database-seperator-import');
    Route::post('/api/product/database/seperator/import', 'API\ProductDatabaseImportController@databaseImportSeperator');

    Route::get('/api/bitcoin/info', 'API\BitcoinWalletController@bitcoinWalletInfo')->name('api-bitcoin-wallet-info');
    Route::post('/api/bitcoin/info', 'API\BitcoinWalletController@bitcoinWalletInfo');
     */

    /*
     * Frontend
     */

    Route::get('/custom/css', 'Custom\CSSController@generateCustomCSS')->name('custom-css');
    Route::get('/custom/colors', 'Custom\CSSController@generateOverridingColorsCSS')->name('custom-colors');

    // Default
    Route::get('/', 'App\DefaultController@showIndex')->name('index');
    Route::get('/article/{id}', 'App\DefaultController@showArticle')->name('article');
    Route::get('/page/{page?}', 'App\DefaultController@showIndex')->name('index-with-pageNumber');

    // Auth
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    /*
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    */

    // UserPanel
    Route::get('home', 'UserPanel\UserPanelController@showUserDashboard')->name('home');

    Route::get('coupon/remove/checkout', 'UserPanel\UserPanelController@removeCouponCheckout')->name('remove-coupon-checkout');
    Route::post('coupon/redeem/checkout', 'UserPanel\UserPanelController@redeemCouponCheckout')->name('redeem-coupon-checkout');
    Route::post('coupon/redeem', 'UserPanel\UserPanelController@redeemCoupon')->name('redeem-coupon');

    Route::get('settings', 'UserPanel\UserPanelController@showSettingsPage')->name('settings');

    Route::get('settings/password/change', function () {
        return redirect()->route('settings');
    });

    Route::post('settings/password/change', 'UserPanel\UserPanelController@passwordChangeForm')->name('settings-password-change');

    Route::get('settings/jabber-id/change', function () {
        return redirect()->route('settings');
    });

    Route::post('settings/jabber-id/change', 'UserPanel\UserPanelController@jabberIDChangeForm')->name('settings-jabber-id-change');

    Route::get('settings/mail-address/change', function () {
        return redirect()->route('settings');
    });

    Route::post('settings/mail-address/change', 'UserPanel\UserPanelController@mailAddressChangeForm')->name('settings-mail-address-change');

    Route::get('deposit', 'UserPanel\UserPanelController@showDepositPage')->name('deposit');
    Route::get('deposit-btc', 'UserPanel\UserPanelController@showDepositBtcPage')->name('deposit-btc');
    Route::post('deposit-btc/{id}', 'UserPanel\UserPanelController@depositBtcPaidCheck')->name('deposit-btc-post');
    Route::get('deposit-eth', 'UserPanel\UserPanelController@showDepositEthPage')->name('deposit-eth');
    Route::post('deposit-eth/{id}', 'UserPanel\UserPanelController@depositEthPaidCheck')->name('deposit-eth-post');

    Route::get('orders', 'UserPanel\UserPanelController@showOrdersPage')->name('orders');
    Route::get('orders/page/{page?}', 'UserPanel\UserPanelController@showOrdersPage')->name('orders-with-pageNumber');

    Route::get('tickets', 'UserPanel\TicketController@showTicketsPage')->name('tickets');
    Route::get('tickets/page/{page?}', 'UserPanel\TicketController@showTicketsPage')->name('tickets-with-pageNumber');
    Route::get('ticket/delete/{id}', 'UserPanel\TicketController@deleteTicket')->name('ticket-delete');
    Route::get('ticket/create', 'UserPanel\TicketController@showTicketCreatePage')->name('ticket-create');
    Route::post('ticket/create', 'UserPanel\TicketController@showTicketCreatePage')->name('ticket-create-form');
    Route::post('ticket/reply/{id}', 'UserPanel\TicketController@replyTicket')->name('ticket-reply');
    Route::get('ticket/{id}', 'UserPanel\TicketController@showTicketPage')->name('ticket-id');

    Route::get('transactions', 'UserPanel\UserPanelController@showTransactionsPage')->name('transactions');
    Route::get('transactions/page/{page?}', 'UserPanel\UserPanelController@showTransactionsPage')->name('transactions-with-pageNumber');

    // FAQ
    Route::get('faq', 'FAQ\FAQController@showFAQPage')->name('faq');

    // Language
    Route::get('language/{lang}', 'App\LanguageController@setLanguage')->name('language');

    // Shop
    Route::get('shop', 'Shop\ShopController@showShopPage')->name('shop');

    Route::get('checkout', 'Shop\CartController@checkout')->name('checkout');
    Route::post('checkout', 'Shop\CartController@checkoutSubmit')->name('checkout-form');

    Route::get('cart', 'Shop\CartController@show')->name('cart');
    Route::get('cart/remove/{id?}', 'Shop\CartController@delete')->name('cart-item-delete');
    Route::get('cart/clear', 'Shop\CartController@clear')->name('cart-clear');
    Route::post('ajax/cart/add', 'Shop\CartController@ajaxAddItem')->name('cart-add-item-ajax');
    Route::post('ajax/cart', 'Shop\CartController@cart')->name('cart-ajax');

    Route::get('product/buy/{id?}/{amount?}', 'Shop\ShopController@buyProductForm')->name('buy-product');
    Route::post('product/buy', 'Shop\ShopController@buyProductForm')->name('buy-product-form');
    Route::post('product/buy-confirm', 'Shop\ShopController@buyProductConfirmForm')->name('buy-product-form-confirm');

    Route::get('product/category/{slug}', 'Shop\ShopController@showProductCategoryPage')->name('product-category');

    Route::get('product/{id}', 'Shop\ShopController@showProductPage')->name('product-page');

    Route::get('creditcards', 'Shop\CreditCardsController@showCreditCardsPage')->name('creditcards');
    Route::get('creditcards/page/{page?}', 'Shop\CreditCardsController@showCreditCardsPage')->name('creditcards-with-pageNumber');

    /*
     * Backend
     */

    // Login & Logout
    Route::get('admin/login', 'Backend\LoginController@showLoginPage')->name('backend-login');
    Route::post('admin/login', 'Backend\LoginController@login')->name('backend-login-form');

    Route::post('admin/logout', 'Backend\LogoutController@logout');
    Route::get('admin/logout', 'Backend\LogoutController@logout')->name('backend-logout');

    // Dashboard
    Route::get('admin', 'Backend\DashboardController@showDashboard')->name('backend-dashboard');
    Route::get('admin/dashboard', 'Backend\DashboardController@showDashboard')->name('backend-dashboard');

    // System Settings
    Route::get('admin/system/settings', 'Backend\System\SettingsController@showSettings')->name('backend-system-settings');
    Route::post('admin/system/settings', 'Backend\System\SettingsController@showSettings')->name('backend-system-settings-form');

    // System Bonus
    Route::get('admin/system/bonus', 'Backend\System\BonusController@show')->name('backend-system-bonus');
    Route::post('admin/system/bonus', 'Backend\System\BonusController@show')->name('backend-system-bonus-form');
    Route::get('admin/system/bonus/del/{id}', 'Backend\System\BonusController@delete')->name('backend-system-bonus-del');

    // Design
    Route::get('admin/design', 'Backend\DesignController@page')->name('backend-design');
    Route::post('admin/design', 'Backend\DesignController@page')->name('backend-design-form');

    // Media
    Route::post('admin/media/upload', 'Backend\MediaController@upload')->name('backend-media-upload');
    Route::get('admin/media', 'Backend\MediaController@page')->name('backend-media');
    Route::get('admin/media/page/{page?}', 'Backend\MediaController@page')->name('backend-media-with-pageNumber');
    Route::get('admin/media/delete/{id}', 'Backend\MediaController@delete')->name('backend-media-delete');

    // System Payments
    Route::get('admin/system/payments', 'Backend\System\PaymentsController@showPayments')->name('backend-system-payments');
    Route::post('admin/system/payments', 'Backend\System\PaymentsController@showPayments')->name('backend-system-payments-form');

    // Bitcoin Wallet
    Route::get('admin/bitcoin', 'Backend\Bitcoin\DashboardController@showDashboardPage')->name('backend-bitcoin-dashboard');
    Route::get('admin/bitcoin/page/{page?}', 'Backend\Bitcoin\DashboardController@showDashboardPage')->name('backend-bitcoin-dashboard-with-pageNumber');
    Route::post('admin/bitcoin/sendbtc', 'Backend\Bitcoin\DashboardController@sendBtcForm')->name('backend-bitcoin-sendbtc-form');
    Route::post('admin/bitcoin/primarywallet', 'Backend\Bitcoin\DashboardController@setPrimaryWalletForm')->name('backend-bitcoin-primarywallet-form');

    // Jabber
    Route::get('admin/jabber', 'Backend\JabberController@showJabberPage')->name('backend-jabber');
    Route::post('admin/jabber/newsletter', 'Backend\JabberController@sendNewsletter')->name('backend-jabber-newsletter-form');
    Route::post('admin/jabber/login', 'Backend\JabberController@loginSave')->name('backend-jabber-login-form');

    // Orders
    Route::post('admin/orders/add-note/{id}', 'Backend\OrdersController@addNote')->name('backend-orders-add-note-form');
    Route::get('admin/orders/cancel/{id}', 'Backend\OrdersController@cancelOrder')->name('backend-order-cancel');
    Route::get('admin/orders/complete/{id}', 'Backend\OrdersController@completeOrder')->name('backend-order-complete');
    Route::get('admin/orders/delete/{id}', 'Backend\OrdersController@deleteOrder')->name('backend-order-delete');
    Route::get('admin/orders/id/{id}', 'Backend\OrdersController@showOrder')->name('backend-order-id');
    Route::get('admin/orders', 'Backend\OrdersController@showOrdersPage')->name('backend-orders');
    Route::get('admin/orders/page/{page?}', 'Backend\OrdersController@showOrdersPage')->name('backend-orders-with-pageNumber');
    Route::get('admin/shopping/id/{id}/done', 'Backend\ShoppingsController@done')->name('backend-shopping-done');
    Route::get('admin/shopping/id/{id}', 'Backend\ShoppingsController@showShopping')->name('backend-shopping-id');
    Route::get('admin/shoppings', 'Backend\ShoppingsController@show')->name('backend-shoppings');
    Route::get('admin/shoppings/page/{page?}', 'Backend\ShoppingsController@show')->name('backend-shoppings-with-pageNumber');

    // Product Categories
    Route::get('admin/management/products/category/delete/{id}', 'Backend\Management\ProductsCategoriesController@deleteProductCategory')->name('backend-management-product-category-delete');
    Route::get('admin/management/products/categories', 'Backend\Management\ProductsCategoriesController@showProductsCategoriesPage')->name('backend-management-products-categories');
    Route::get('admin/management/products/categories/page/{page?}', 'Backend\Management\ProductsCategoriesController@showProductsCategoriesPage')->name('backend-management-products-categories-with-pageNumber');
    Route::get('admin/management/products/categories/add', 'Backend\Management\ProductsCategoriesController@showProductCategoryAddPage')->name('backend-management-product-category-add');
    Route::post('admin/management/products/categories/add', 'Backend\Management\ProductsCategoriesController@addProductCategoryForm')->name('backend-management-product-category-add-form');
    Route::any('admin/management/products/categories/lang/{lang}/edit/{id}', 'Backend\Management\ProductsCategoriesController@showProductCategoryEditPageLang')->name('lang-edit-product-category');
    Route::get('admin/management/products/categories/edit/{id}', 'Backend\Management\ProductsCategoriesController@showProductCategoryEditPage')->name('backend-management-product-category-edit');
    Route::post('admin/management/products/categories/edit', 'Backend\Management\ProductsCategoriesController@editProductCategoryForm')->name('backend-management-product-category-edit-form');

    // Products
    Route::get('admin/management/product/bonus/{id}', 'Backend\Management\ProductsController@showProductBonusPage')->name('backend-management-product-bonus');
    Route::post('admin/management/product/bonus/{id}', 'Backend\Management\ProductsController@showProductBonusPage')->name('backend-management-product-bonus-form');
    Route::get('admin/management/product/bonus/{id}/del/{bid}', 'Backend\Management\ProductsController@deleteBonus')->name('backend-management-product-bonus-del');

    Route::get('admin/management/product/database/{id}', 'Backend\Management\ProductsController@showProductDatabasePage')->name('backend-management-product-database');
    Route::get('admin/management/product/database/{id}/page/{page?}', 'Backend\Management\ProductsController@showProductDatabasePage')->name('backend-management-product-database-with-pageNumber');
    Route::get('admin/management/product/database/search/{id}', 'Backend\Management\ProductsController@showProductDatabasePageSearch')->name('backend-management-product-database-search');
    Route::post('admin/management/product/database/search/{id}', 'Backend\Management\ProductsController@showProductDatabasePageSearch')->name('backend-management-product-database-search');
    Route::get('admin/management/product/database/search/{id}/page/{page?}', 'Backend\Management\ProductsController@showProductDatabasePageSearch')->name('backend-management-product-database-search-with-pageNumber');
    Route::get('admin/management/product/database/delete/{id}', 'Backend\Management\ProductsController@deleteProductItem')->name('backend-management-product-database-delete');
    Route::get('admin/management/product/database/edit/{id}', 'Backend\Management\ProductsController@editProductItem')->name('backend-management-product-database-edit');
    Route::post('admin/management/product/database/edit/{id}', 'Backend\Management\ProductsController@editProductItem')->name('backend-management-product-database-edit-form');
    Route::post('admin/management/product/database/import/txt', 'Backend\Management\ProductsController@databaseImportTXT')->name('backend-management-product-database-import-txt');
    Route::post('admin/management/product/database/import/one', 'Backend\Management\ProductsController@databaseImportONE')->name('backend-management-product-database-import-one');
    Route::get('admin/management/product/delete/{id}', 'Backend\Management\ProductsController@deleteProduct')->name('backend-management-product-delete');
    Route::get('admin/management/products/add', 'Backend\Management\ProductsController@showProductAddPage')->name('backend-management-product-add');
    Route::post('admin/management/products/add', 'Backend\Management\ProductsController@addProductForm')->name('backend-management-product-add-form');
    Route::any('admin/management/products/lang/{lang}/edit/{id}', 'Backend\Management\ProductsController@showProductEditPageLang')->name('lang-edit-product');
    Route::get('admin/management/products/edit/{id}', 'Backend\Management\ProductsController@showProductEditPage')->name('backend-management-product-edit');
    Route::post('admin/management/products/edit', 'Backend\Management\ProductsController@editProductForm')->name('backend-management-product-edit-form');
    Route::get('admin/management/products', 'Backend\Management\ProductsController@showProductsPage')->name('backend-management-products');
    Route::get('admin/management/products/page/{page?}', 'Backend\Management\ProductsController@showProductsPage')->name('backend-management-products-with-pageNumber');

    /*
    Route::get('admin/management/creditcards', 'Backend\Management\CreditCardsController@showCreditCardsPage')->name('backend-management-creditcards');
    Route::get('admin/management/creditcards/page/{page?}', 'Backend\Management\CreditCardsController@showCreditCardsPage')->name('backend-management-creditcards-with-pageNumber');
    */

    // Ticket Categories
    Route::any('admin/management/tickets/category/lang/{lang}/edit/{id}', 'Backend\Management\TicketsCategoriesController@showTicketCategoryEditPageLang')->name('lang-edit-ticket-category');
    Route::get('admin/management/tickets/category/delete/{id}', 'Backend\Management\TicketsCategoriesController@deleteTicketCategory')->name('backend-management-ticket-category-delete');
    Route::get('admin/management/tickets/categories', 'Backend\Management\TicketsCategoriesController@showTicketsCategoriesPage')->name('backend-management-tickets-categories');
    Route::get('admin/management/tickets/categories/page/{page?}', 'Backend\Management\TicketsCategoriesController@showTicketsCategoriesPage')->name('backend-management-tickets-categories-with-pageNumber');
    Route::get('admin/management/tickets/categories/add', 'Backend\Management\TicketsCategoriesController@showTicketCategoryAddPage')->name('backend-management-ticket-category-add');
    Route::post('admin/management/tickets/categories/add', 'Backend\Management\TicketsCategoriesController@addTicketCategoryForm')->name('backend-management-ticket-category-add-form');
    Route::get('admin/management/tickets/categories/edit/{id}', 'Backend\Management\TicketsCategoriesController@showTicketCategoryEditPage')->name('backend-management-ticket-category-edit');
    Route::post('admin/management/tickets/categories/edit', 'Backend\Management\TicketsCategoriesController@editTicketCategoryForm')->name('backend-management-ticket-category-edit-form');

    // Tickets
    Route::get('admin/management/ticket/delete/{id}', 'Backend\Management\TicketsController@deleteTicket')->name('backend-management-ticket-delete');
    Route::get('admin/management/ticket/edit/{id}', 'Backend\Management\TicketsController@showTicketEditPage')->name('backend-management-ticket-edit');
    Route::get('admin/management/ticket/close/{id}', 'Backend\Management\TicketsController@closeTicket')->name('backend-management-ticket-close');
    Route::get('admin/management/ticket/open/{id}', 'Backend\Management\TicketsController@openTicket')->name('backend-management-ticket-open');
    Route::post('admin/management/ticket/reply', 'Backend\Management\TicketsController@replyTicketForm')->name('backend-management-ticket-reply-form');
    Route::post('admin/management/ticket/move-category', 'Backend\Management\TicketsController@moveTicketForm')->name('backend-management-ticket-move-form');
    Route::get('admin/management/tickets', 'Backend\Management\TicketsController@showTicketsPage')->name('backend-management-tickets');
    Route::get('admin/management/tickets/page/{page?}', 'Backend\Management\TicketsController@showTicketsPage')->name('backend-management-tickets-with-pageNumber');

    // FAQ Categories
    Route::any('admin/management/faqs/categories/lang/{lang}/edit/{id}', 'Backend\Management\FAQsCategoriesController@showFAQCategoryEditPageLang')->name('lang-edit-faq-category');

    Route::get('admin/management/faqs/category/delete/{id}', 'Backend\Management\FAQsCategoriesController@deleteFAQCategory')->name('backend-management-faq-category-delete');
    Route::get('admin/management/faqs/categories', 'Backend\Management\FAQsCategoriesController@showFAQsCategoriesPage')->name('backend-management-faqs-categories');
    Route::get('admin/management/faqs/categories/page/{page?}', 'Backend\Management\FAQsCategoriesController@showFAQsCategoriesPage')->name('backend-management-faqs-categories-with-pageNumber');
    Route::get('admin/management/faqs/categories/add', 'Backend\Management\FAQsCategoriesController@showFAQCategoryAddPage')->name('backend-management-faq-category-add');
    Route::post('admin/management/faqs/categories/add', 'Backend\Management\FAQsCategoriesController@addFAQCategoryForm')->name('backend-management-faq-category-add-form');
    Route::get('admin/management/faqs/categories/edit/{id}', 'Backend\Management\FAQsCategoriesController@showFAQCategoryEditPage')->name('backend-management-faq-category-edit');
    Route::post('admin/management/faqs/categories/edit', 'Backend\Management\FAQsCategoriesController@editFAQCategoryForm')->name('backend-management-faq-category-edit-form');

    // FAQ
    Route::any('admin/management/faq/lang/{lang}/edit/{id}', 'Backend\Management\FAQsController@showFAQEditPageLang')->name('lang-edit-faq');

    Route::get('admin/management/faq/delete/{id}', 'Backend\Management\FAQsController@deleteFAQ')->name('backend-management-faq-delete');
    Route::get('admin/management/faq/edit/{id}', 'Backend\Management\FAQsController@showFAQEditPage')->name('backend-management-faq-edit');
    Route::post('admin/management/faq/edit', 'Backend\Management\FAQsController@editFAQForm')->name('backend-management-faq-edit-form');
    Route::get('admin/management/faq/add', 'Backend\Management\FAQsController@showFAQAddPage')->name('backend-management-faq-add');
    Route::post('admin/management/faq/add', 'Backend\Management\FAQsController@addFAQForm')->name('backend-management-faq-add-form');
    Route::get('admin/management/faqs', 'Backend\Management\FAQsController@showFAQsPage')->name('backend-management-faqs');
    Route::get('admin/management/faqs/page/{page?}', 'Backend\Management\FAQsController@showFAQsPage')->name('backend-management-faqs-with-pageNumber');

    // Articles
    Route::get('admin/management/article/delete/{id}', 'Backend\Management\ArticlesController@deleteArticle')->name('backend-management-article-delete');
    Route::any('admin/management/article/lang/{lang}/edit/{id}', 'Backend\Management\ArticlesController@showArticleEditPageLang')->name('lang-edit-article');
    Route::get('admin/management/article/edit/{id}', 'Backend\Management\ArticlesController@showArticleEditPage')->name('backend-management-article-edit');
    Route::post('admin/management/article/edit', 'Backend\Management\ArticlesController@editArticleForm')->name('backend-management-article-edit-form');
    Route::get('admin/management/article/add', 'Backend\Management\ArticlesController@showArticleAddPage')->name('backend-management-article-add');
    Route::post('admin/management/article/add', 'Backend\Management\ArticlesController@addArticleForm')->name('backend-management-article-add-form');
    Route::get('admin/management/articles', 'Backend\Management\ArticlesController@showArticlesPage')->name('backend-management-articles');
    Route::get('admin/management/articles/page/{page?}', 'Backend\Management\ArticlesController@showArticlesPage')->name('backend-management-articles-with-pageNumber');

    // User Orders
    Route::get('admin/user/{userid}/orders/cancel/{id}', 'Backend\OrdersController@cancelUserOrder')->name('backend-user-order-cancel');
    Route::get('admin/user/{userid}/orders/complete/{id}', 'Backend\OrdersController@completeUserOrder')->name('backend-user-order-complete');
    Route::get('admin/user/{userid}/orders/delete/{id}', 'Backend\OrdersController@deleteUserOrder')->name('backend-user-order-delete');

    // Users
    Route::get('admin/management/user/login/{id}', 'Backend\Management\UsersController@loginAsUser')->name('backend-management-user-login');
    Route::get('admin/management/user/delete/{id}', 'Backend\Management\UsersController@deleteUser')->name('backend-management-user-delete');
    Route::get('admin/management/user/edit/{id}', 'Backend\Management\UsersController@showUserEditPage')->name('backend-management-user-edit');
    Route::get('admin/management/user/tickets/{id}', 'Backend\Management\UsersController@showTickets')->name('backend-management-user-tickets');
    Route::get('admin/management/user/tickets/{id}/page/{page?}', 'Backend\Management\UsersController@showTickets')->name('backend-management-user-tickets-with-pageNumber');
    Route::get('admin/management/user/orders/{id}', 'Backend\Management\UsersController@showOrders')->name('backend-management-user-orders');
    Route::get('admin/management/user/orders/{id}/page/{page?}', 'Backend\Management\UsersController@showOrders')->name('backend-management-user-orders-with-pageNumber');
    Route::post('admin/management/user/update/permissions', 'Backend\Management\UsersController@updateUserPermissionsForm')->name('backend-management-user-update-permissions-form');
    Route::post('admin/management/user/edit', 'Backend\Management\UsersController@editUserForm')->name('backend-management-user-edit-form');
    Route::get('admin/management/users', 'Backend\Management\UsersController@showUsersPage')->name('backend-management-users');
    Route::get('admin/management/users/page/{page?}', 'Backend\Management\UsersController@showUsersPage')->name('backend-management-users-with-pageNumber');

    // Coupons
    Route::get('admin/management/coupon/delete/{id}', 'Backend\Management\CouponsController@deleteCoupon')->name('backend-management-coupon-delete');
    Route::get('admin/management/coupon/edit/{id}', 'Backend\Management\CouponsController@showCouponEditPage')->name('backend-management-coupon-edit');
    Route::post('admin/management/coupon/edit', 'Backend\Management\CouponsController@editCouponForm')->name('backend-management-coupon-edit-form');
    Route::get('admin/management/coupon/add', 'Backend\Management\CouponsController@showCouponAddPage')->name('backend-management-coupon-add');
    Route::post('admin/management/coupon/add', 'Backend\Management\CouponsController@addCouponForm')->name('backend-management-coupon-add-form');
    Route::get('admin/management/coupons', 'Backend\Management\CouponsController@showCouponsPage')->name('backend-management-coupons');
    Route::get('admin/management/coupons/page/{page?}', 'Backend\Management\CouponsController@showCouponsPage')->name('backend-management-coupons-with-pageNumber');

    // DeliveryMethods
    Route::get('admin/management/delivery-method/delete/{id}', 'Backend\Management\DeliveryMethodsController@deleteDeliveryMethod')->name('backend-management-delivery-method-delete');
    Route::get('admin/management/delivery-method/edit/{id}', 'Backend\Management\DeliveryMethodsController@showDeliveryMethodEditPage')->name('backend-management-delivery-method-edit');
    Route::post('admin/management/delivery-method/edit', 'Backend\Management\DeliveryMethodsController@editDeliveryMethodForm')->name('backend-management-delivery-method-edit-form');
    Route::get('admin/management/delivery-method/add', 'Backend\Management\DeliveryMethodsController@showDeliveryMethodAddPage')->name('backend-management-delivery-method-add');
    Route::post('admin/management/delivery-method/add', 'Backend\Management\DeliveryMethodsController@addDeliveryMethodForm')->name('backend-management-delivery-method-add-form');
    Route::get('admin/management/delivery-methods', 'Backend\Management\DeliveryMethodsController@showDeliveryMethodsPage')->name('backend-management-delivery-methods');
    Route::get('admin/management/delivery-methods/page/{page?}', 'Backend\Management\DeliveryMethodsController@showDeliveryMethodsPage')->name('backend-management-delivery-methods-with-pageNumber');

    // Notifications
    Route::get('admin/notifications/clear', 'Backend\NotificationsController@deleteAllNotifications')->name('backend-notifications-clear');
    Route::get('admin/notification/delete/{id}', 'Backend\NotificationsController@deleteNotification')->name('backend-notification-delete');
    Route::get('admin/notifications', 'Backend\NotificationsController@showNotificationsPage')->name('backend-notifications');
    Route::get('admin/notifications/page/{page?}', 'Backend\NotificationsController@showNotificationsPage')->name('backend-notifications-with-pageNumber');

    // JSON
    Route::post('admin/api/recent-orders', 'Backend\API\JSONController@getRecentOrders')->name('backend-api-recent-orders');
    Route::get('admin/api/recent-orders', 'Backend\API\JSONController@getRecentOrders')->name('backend-api-recent-orders');

    Route::post('admin/api/recent-tickets', 'Backend\API\JSONController@getRecentTickets')->name('backend-api-recent-tickets');
    Route::get('admin/api/recent-tickets', 'Backend\API\JSONController@getRecentTickets')->name('backend-api-recent-tickets');

    Route::get('admin/api/notifications', 'Backend\API\JSONController@getNotifications')->name('backend-api-notifications');
