<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if(isset($productCategory) && $productCategory != null && !$productCategoryUncategorized)
        @include('meta::manager', [
            'title'         => config('app.name') . ' - ' . $productCategory->name,
            'description'   => $productCategory->meta_tags_desc,
            'keywords'   => $productCategory->keywords
        ])
        @else
        @include('meta::manager', [
            'title'         => $metaTITLE ?? config('app.name'),
            'description'   => $metaDESC ?? '',
            'keywords'   => $metaKEYS ?? ''
        ])
        @endif

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet" type="text/css" />

        <link rel="icon" href="@if(strlen(App\Models\Setting::get('theme.favicon')) > 0){{ App\Models\Setting::get('theme.favicon') }}@else{{ asset_dir('favicon.svg') }}@endif" sizes="any" />

        <!-- Bootstrap -->
        <link href="{{ asset_dir('vendor/bootstrap-4.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset_dir('css/app.css') }}" rel="stylesheet" />
        
        @if(App\Models\Setting::get('theme.color.enable', 0))
        <link href="{{ route('custom-colors') }}" rel="stylesheet" />
        @endif

        @if(strlen(App\Models\Setting::get('theme.background')) > 0)
        <style type="text/css">
            body {
                background-image: url('{{ App\Models\Setting::get('theme.background') }}');
            }
        </style>
        @endif

        <link href="{{ asset_dir('css/theme.css') }}" rel="stylesheet" />

        <link href="{{ route('custom-css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <div class="">
                <div class="">
                    <div class="">
                        <nav class="navbar navbar-expand-lg navbar-light nav-shop nav-log">
                            <div class="container">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    @if(strlen(App\Models\Setting::get('theme.logo')) > 0)
                                    <img src="{{ App\Models\Setting::get('theme.logo') }}" alt="logo" style="max-width: 200px;" />
                                    @else
                                    {{ config('app.name') }}
                                    @endif
                                </a>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('frontend/main.toggle_navigation') }}">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/') }}">{{ __('frontend/main.home') }}</a>
                                        </li>

                                        @php
                                            $productCategories = \App\Models\ProductCategory::all()
                                        @endphp
                                        <li class="nav-item @if(count($productCategories) > 0) dropdown @endif">
                                            @if(count($productCategories) > 0 || App\Models\Setting::get('shop.creditcards.enabled'))
                                                <a id="navbarDropdownShop" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ __('frontend/main.shop') }}
                                                </a>
                                            @else
                                                <a class="nav-link" href="{{ route('shop') }}">
                                                    {{ __('frontend/main.shop') }}
                                                </a>
                                            @endif

                                            @if(count($productCategories) > 0 || App\Models\Setting::get('shop.creditcards.enabled'))
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('shop') }}">
                                                    {{ __('frontend/shop.all_categories') }}
                                                </a>

                                                <div class="dropdown-divider"></div>

                                                @if(App\Models\Setting::get('shop.creditcards.enabled'))
                                                    <a class="dropdown-item" href="{{ route('creditcards') }}">
                                                        {{ __('frontend/shop.creditcards') }}
                                                    </a>

                                                    @if(count($productCategories) > 0)
                                                    <div class="dropdown-divider"></div>
                                                    @endif
                                                @endif

                                                @if(count($productCategories) > 0)
                                                    @foreach($productCategories as $productCategory)
                                                    <a class="dropdown-item" href="{{ route('product-category', [$productCategory->slug]) }}">
                                                        {{ \App\Classes\LangHelper::getValue(app()->getLocale(), 'product-category', null, $productCategory->id) ?? $productCategory->name }}
                                                    </a>
                                                    @endforeach

                                                    @if(count(App\Models\Product::getUncategorizedProducts()))
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="{{ route('product-category', ['uncategorized']) }}">
                                                        {{ __('frontend/shop.uncategorized') }}
                                                    </a>
                                                    @endif
                                                @endif
                                            </div>
                                            @endif
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('faq') }}">{{ __('frontend/main.faq') }}</a>
                                        </li>

                                        @auth
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdownShop" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ __('frontend/main.tickets') }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('tickets') }}">
                                                    {{ __('frontend/main.my_tickets') }}
                                                </a>
                                            
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="{{ route('ticket-create') }}">
                                                    {{ __('frontend/main.create_ticket') }}
                                                </a>
                                            </div>
                                        </li>
                                        @endauth
                                        
                                
                                        </ul>
                                    <ul class="navbar-nav ml-auto">
                                        
                                        @guest
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-outline-secondary topnavBtn" href="{{ route('login') }}">{{ __('frontend/main.login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link btn btn-outline-secondary  topnavBtn" href="{{ route('register') }}">{{ __('frontend/main.register') }}</a>
                                            </li>
                                            @endif
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link activated-link btn topnavBtn" href="{{ route('deposit') }}">
                                                    <ion-icon name="wallet"></ion-icon>
                                                    {{ Auth::user()->getFormattedBalance() }}
                                                </a>
                                            </li>@auth
                                        <li class="nav-item nonavlnk">
                                            <a href="{{ route('cart') }}" class="nav-link nav-link-btc btn topnavBtn">
                                                <ion-icon name="cart"></ion-icon>
                                                <span id="cart-name">
                                                    {{ \App\Models\UserCart::getCartCountByUserId(\Auth::user()->id) }}
                                                </span>
                                            </a>
                                        </li>
                                        @endauth

                                            <li class="nav-item active dropdown">
                                                <a id="navbarDropdownUser" class="nav-link dropdown-toggle btn btn-gardient btn-inline-block active " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    <ion-icon name="person"></ion-icon>
                                                    <span class="caret"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
                                                    <a class="dropdown-item" href="{{ route('home') }}">
                                                        {{ __('frontend/user.profile') }}
                                                    </a>

                                                    <a class="dropdown-item" href="{{ route('orders') }}">
                                                        {{ __('frontend/user.orders') }}
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="{{ route('deposit') }}">
                                                        {{ __('frontend/user.deposit') }}
                                                    </a>

                                                    <a class="dropdown-item" href="{{ route('transactions') }}">
                                                        {{ __('frontend/user.transactions') }}
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="{{ route('settings') }}">
                                                        {{ __('frontend/user.settings') }}
                                                    </a>

                                                    @if(Auth::user()->hasPermission('access_backend'))
                                                    <div class="dropdown-divider"></div>

                                                    <a class="dropdown-item" href="{{ route('backend-dashboard') }}" target="_panel">
                                                        {{ __('frontend/user.admin_panel') }}
                                                        <ion-icon name="open"></ion-icon>
                                                    </a>

                                                    <div class="dropdown-divider"></div>
                                                    @endif

                                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        {{ __('frontend/main.logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </nav>
                     
                    </div>
                </div>
            </div>
            
            <main class="py-4">
                @if (\Session::has('errorMessage'))
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    {!! \Session::get('errorMessage') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (\Session::has('successMessage'))
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    {!! \Session::get('successMessage') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span>&copy; 2020 {{ App\Models\Setting::get('app.name') }}. All rights reserved.</span>
                        </div>
                        <div class="col-md-6 text-right mt-15">
                 
                                           
                                        <a href="#" class="kursbtn">
                                                1 BTC = {{ App\Classes\BitcoinAPI::getFormatted(App\Classes\BitcoinAPI::convertBtc(1)) }}
                                            </a>
                        @if(!count(App\Models\Setting::getAvailableLocales()))

                        @endif

                                            @if(count(App\Models\Setting::getAvailableLocales())) 
                                            
                                                @foreach(App\Models\Setting::getAvailableLocales() as $locale)
                                                <a class="localelink @if($locale == app()->getLocale()) localelink-active @endif" href="{{ route('language', $locale) }}">
                                                    <img class="flag-icon-img" src="{{ asset_dir('svg/flags/' . \Lang::get('locale.icon', [], $locale) . '.svg') }}" />
                                                    <span class="flag-icon-name">{{ \Lang::get('locale.name', [], $locale) }}</span>
                                                </a>
                                                @endforeach
                                            
                                            @endif
                                </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script src="{{ asset_dir('vendor/jquery-3.3.1/js/jquery-3.3.1.min.js') }}" defer></script>
        <script src="{{ asset_dir('vendor/bootstrap-4.1.3/js/bootstrap.min.js') }}" defer></script>

        <script src="//unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

        <script type="text/javascript">
            function updateCart() {
                //$('#cart-name').html('{{ __('frontend/v4.adding_cart') }}');

                $.ajax({
                    'url': '{{ route('cart-ajax') }}',
                    method: 'POST'
                })
                .done(function(response) {
                    $('#cart-name').html(response);
                })
                .fail(function() {
                    $('#cart-name').html('{{ __('frontend/v4.unknown_error') }}');
                });
            }

            function addToCart(productId, amountClass) {
                if(!$('a[cart-btn=' + productId + ']').hasClass('disabled')) {
                    var amount = parseInt($(amountClass).val());
                    $(amountClass).val('');

                    if(amount > 0) {
                        $('a[cart-btn=' + productId + ']').addClass('disabled');

                        $.ajax({
                            'url': '{{ route('cart-add-item-ajax') }}',
                            method: 'POST',
                            data: {product_id:productId, amount:amount}
                        })
                        .done(function(response) {
                             updateCart();

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .fail(function() {
                            alert("Unbekannter Fehler, Seite neuladen.");

                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        })
                        .always(function() {
                            $('a[cart-btn=' + productId + ']').removeClass('disabled');
                        });
                    }
                }
            }
            
            @if(isset($clipboardJS))
            var clipboard = new ClipboardJS('{{ $clipboardJS->element }}');

            clipboard.on('success', function(e) {
                $('{{ $clipboardJS->fadeIn }}').css('display', 'block').hide().fadeIn();
            });
            @endif
        </script>
    </body>
</html>
