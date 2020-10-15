<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="description" content="" />

		<title>{{ config('backend.name') }}</title>

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js" type="text/javascript"></script>

		<script type="text/javascript">
			WebFont.load({
                google: {"families": [
					"Poppins:300,400,500,600,700"
				]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

		<!--end::Web font -->

		<!--begin::Page Vendors Styles -->
		<link href="{{ asset_dir('admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Page Vendors Styles -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="{{ asset_dir('admin/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<link href="{{ asset_dir('admin/assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/vendors/custom/vendors/fontawesome5/css/all.min.css') }}" rel="stylesheet" type="text/css" />

		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles -->
		<link href="{{ asset_dir('admin/assets/files/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset_dir('admin/assets/media/logos/favicon.ico') }}" />

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/codemirror.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.0/addon/hint/show-hint.css" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="k-page--loading-enabled k-page--loading k-page--fixed k-header--fixed k-header--minimize-menu k-header-mobile--fixed">

		<!-- begin::Page loader -->

		<!-- end::Page Loader -->

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="k_header_mobile" class="k-header-mobile  k-header-mobile--fixed ">
			<div class="k-header-mobile__logo">
				<a href="{{ route('backend-dashboard') }}">
					<img alt="" src="{{ asset_dir('admin/assets/media/logos/logo-5.png') }}" />
				</a>
			</div>
			<div class="k-header-mobile__toolbar">
				<button class="k-header-mobile__toolbar-toggler" id="k_header_mobile_toggler"><span></span></button>
				<button class="k-header-mobile__toolbar-topbar-toggler" id="k_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="k-grid k-grid--hor k-grid--root">
			<div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
				<div class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper" id="k_wrapper">

					<!-- begin:: Header -->
					<div id="k_header" class="k-header k-grid__item  k-header--fixed" data-kheader-minimize="on" style="background-image: url({{ asset_dir('admin/assets/files/media/layout/header-bg.jpg') }})">
						<div class="k-header__top">
							<div class="k-container">

								<!-- begin:: Brand -->
								<div class="k-header__brand   k-grid__item" id="k_header_brand">
									<div class="k-header__brand-logo">
										<a href="{{ route('backend-dashboard') }}">
											<img src="{{ asset_dir('admin/assets/media/logos/logo-7.png') }}" class="k-header__brand-logo-default" />
											<img src="{{ asset_dir('admin/assets/media/logos/logo-5.png') }}" class="k-header__brand-logo-sticky" />
										</a>
									</div>
								</div>

								<!-- end:: Brand -->

								<!-- begin:: Header Topbar -->
								<div class="k-header__topbar">
									<!--begin: Search -->
									<!--<div class="k-header__topbar-item k-header__topbar-item--search">
										<div class="k-input-icon k-input-icon--right">
											<input type="text" class="form-control" placeholder="{{ __('backend/header.search.placeholder') }}">
											<span class="k-input-icon__icon k-input-icon__icon--right">
												<span><i class="la la-search"></i></span>
											</span>
										</div>
									</div>-->
									<!--end: Search -->

									<!--begin: Quick actions -->
									<div class="k-header__topbar-item dropdown">
										<div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px 10px">
											<span class="k-header__topbar-icon"><i class="flaticon-layers"></i></span>
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
											<div class="k-head k-head--sm k-head--skin-light">
												<h3 class="k-head__title">{{ __('backend/header.quickmenu.title') }}</h3>
											</div>
											<div class="k-grid-nav">
												@if(Auth::user()->hasPermission('manage_bitcoin_wallet'))
												<a href="{{ route('backend-bitcoin-dashboard') }}" class="k-grid-nav__item">
													<div class="k-grid-nav__item-icon"><i class="flaticon2-list"></i></div>
													<div class="k-grid-nav__item-title">{{ __('backend/header.quickmenu.bitcoin_wallet') }}</div>
													<div class="k-grid-nav__item-desc">{{ __('backend/header.quickmenu.bitcoin_wallet_management') }}</div>
												</a>
												@endif

												@if(Auth::user()->hasPermission('manage_users'))
												<a href="{{ route('backend-management-users') }}" class="k-grid-nav__item">
													<div class="k-grid-nav__item-icon"><i class="flaticon-users"></i></div>
													<div class="k-grid-nav__item-title">{{ __('backend/header.quickmenu.users') }}</div>
													<div class="k-grid-nav__item-desc">{{ __('backend/header.quickmenu.users_management') }}</div>
												</a>
												@endif

												@if(Auth::user()->hasPermission('manage_articles'))
												<a href="{{ route('backend-management-articles') }}" class="k-grid-nav__item">
													<div class="k-grid-nav__item-icon"><i class="flaticon2-open-text-book"></i></div>
													<div class="k-grid-nav__item-title">{{ __('backend/header.quickmenu.articles') }}</div>
													<div class="k-grid-nav__item-desc">{{ __('backend/header.quickmenu.articles_management') }}</div>
												</a>
												@endif
												
												@if(Auth::user()->hasPermission('manage_tickets'))
												<a href="{{ route('backend-management-tickets') }}" class="k-grid-nav__item">
													<div class="k-grid-nav__item-icon"><i class="flaticon2-chat-1"></i></div>
													<div class="k-grid-nav__item-title">{{ __('backend/header.quickmenu.tickets') }}</div>
													<div class="k-grid-nav__item-desc">{{ __('backend/header.quickmenu.tickets_management') }}</div>
												</a>
												@endif
											</div>
										</div>
									</div>

									<!--end: Quick actions -->

									<!--begin: Notifications -->
									@php( $notificationsCount = App\Models\Notification::where('readed', 'false')->get()->count() )
									<div id="dropdown-notifications" class="k-header__topbar-item dropdown">
										<div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px 10px">
											<span class="k-header__topbar-icon"><i class="flaticon-alarm"></i></span>
											<span id="notifications-count" class="k-badge k-badge--danger">{{ $notificationsCount }}</span>
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
											<div class="k-head k-head--sm k-head--skin-light">
												<h3 class="k-head__title">{{ __('backend/header.notifications.title') }}</h3>
											</div>
											<div id="notifications-content" class="k-notification k-margin-t-10 k-margin-b-10 k-scroll" data-scroll="true" data-height="270">
												
											</div>
											<div class="k-bottom">
												<a href="{{ route('backend-notifications') }}" class="k-bottom-btn">Alle Benachrichtigungen</a>
											</div>
										</div>
									</div>

									<!--end: Notifications -->

									<!--begin: Language bar -->
									<div class="k-header__topbar-item k-header__topbar-item--langs">
										<div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px 10px">
											<span class="k-header__topbar-icon">
												<img class="" src="{{ asset_dir('admin/assets/media/flags/017-germany.svg') }}" alt="" />
											</span>
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
											<ul class="k-nav k-margin-t-10 k-margin-b-10">
												<li class="k-nav__item">
													<a href="#" class="k-nav__link">
														<span class="k-nav__link-icon"><img src="{{ asset_dir('admin/assets/media/flags/017-germany.svg') }}" alt="" /></span>
														<span class="k-nav__link-text">{{ __('backend/header.languages.german') }}</span>
													</a>
												</li>
											</ul>
										</div>
									</div>

									<!--end: Language bar -->

									<!--begin: User bar -->
									<div class="k-header__topbar-item k-header__topbar-item--user">
										<div class="k-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px 10px">
											<img alt="" src="{{ asset_dir('admin/assets/media/users/default.jpg') }}" />
										</div>
										<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
											<div class="k-user-card k-user-card--skin-light k-margin-b-50 k-margin-b-20-tablet-and-mobile">
												<div class="k-user-card__wrapper">
													<div class="k-user-card__pic">
														<img alt="" src="{{ asset_dir('admin/assets/media/users/default.jpg') }}" />
													</div>
													<div class="k-user-card__details">
														<div class="k-user-card__name">{{ Auth::user()->username }}</div>
														<div class="k-user-card__position">{{ Auth::user()->jabber_id }}</div>
													</div>
												</div>
											</div>
											<ul class="k-nav k-margin-b-10">
												<li class="k-nav__item">
													<a href="#" class="k-nav__link">
														<span class="k-nav__link-icon"><i class="flaticon-profile"></i></span>
														<span class="k-nav__link-text">{{ __('backend/header.profile') }}</span>
													</a>
												</li>
												<li class="k-nav__item">
													<a href="{{ route('settings') }}" class="k-nav__link">
														<span class="k-nav__link-icon"><i class="flaticon-settings"></i></span>
														<span class="k-nav__link-text">{{ __('backend/header.settings') }}</span>
													</a>
												</li>
												<li class="k-nav__item k-nav__item--custom k-margin-t-15">
													<a href="{{ route('backend-logout') }}" class="btn btn-outline-metal btn-hover-brand btn-upper btn-font-dark btn-sm btn-bold">
														{{ __('backend/header.logout') }}
													</a>
												</li>
											</ul>
										</div>
									</div>

									<!--end: User bar -->
								</div>

								<!-- end:: Header Topbar -->
							</div>
						</div>
						<div class="k-header__bottom">
							<div class="k-container">

								<!-- begin: Header Menu -->
								<button class="k-header-menu-wrapper-close" id="k_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
								<div class="k-header-menu-wrapper" id="k_header_menu_wrapper">
									<div id="k_header_menu" class="k-header-menu k-header-menu-mobile ">
										<ul class="k-menu__nav ">
										<li class="k-menu__item  k-menu__item--open @if(\Route::currentRouteName() == 'backend-dashboard') k-menu__item--here @endif k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="{{ route('backend-dashboard') }}" class="k-menu__link">
													<span class="k-menu__link-text">{{ __('backend/dashboard.title') }}</span>
												</a>
											</li>

											@if(Auth::user()->hasPermission('jabber_newsletter'))
											<li class="k-menu__item  k-menu__item--open @if(\Route::currentRouteName() == 'backend-jabber') k-menu__item--here @endif k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="{{ route('backend-jabber') }}" class="k-menu__link">
													<span class="k-menu__link-text">{{ __('backend/jabber.title') }}</span>
												</a>
											</li>
											@endif

											@if(Auth::user()->hasPermission('manage_orders'))
											<li class="k-menu__item  k-menu__item--open @if(\Route::currentRouteName() == 'backend-orders' || \Route::currentRouteName() == 'backend-orders-with-pageNumber') k-menu__item--here @endif k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="{{ route('backend-orders') }}" class="k-menu__link">
													<span class="k-menu__link-text">{{ __('backend/orders.title') }}</span>
												</a>
											</li>
											@endif

											@if(Auth::user()->hasPermission('manage_design'))
											<li class="k-menu__item  k-menu__item--open @if(\Route::currentRouteName() == 'backend-design') k-menu__item--here @endif k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="{{ route('backend-design') }}" class="k-menu__link">
													<span class="k-menu__link-text">{{ __('backend/design.title') }}</span>
												</a>
											</li>
											@endif

											@if(Auth::user()->hasPermission('manage_media'))
											<li class="k-menu__item  k-menu__item--open @if(\Route::currentRouteName() == 'backend-media' || \Route::currentRouteName() == 'backend-media-with-pageNumber') k-menu__item--here @endif k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="{{ route('backend-media') }}" class="k-menu__link">
													<span class="k-menu__link-text">{{ __('backend/media.title') }}</span>
												</a>
											</li>
											@endif

											@if(Auth::user()->hasAnyPermissionFromArray([
												'manage_articles',
												'manage_faqs',
												'manage_faqs_categories',
												'manage_products',
												'manage_products_categories',
												'manage_tickets',
												'manage_tickets_categories',
												'manage_users',
												'manage_coupons',
												'manage_delivery_methods'
											]))
											<li class="k-menu__item @if(isset($managementPage)) k-menu__item--here @endif k-menu__item--open k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="k-menu__link k-menu__toggle">
													<span class="k-menu__link-text">{{ __('backend/management.title') }}</span>
													<i class="k-menu__hor-arrow la la-angle-down"></i>
													<i class="k-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="k-menu__submenu k-menu__submenu--classic k-menu__submenu--left">
													<ul class="k-menu__subnav">
														@if(Auth::user()->hasPermission('manage_tickets') || Auth::user()->hasPermission('manage_tickets_categproes'))
														<li class="k-menu__item k-menu__item--submenu" data-kmenu-submenu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="k-menu__link k-menu__toggle">
																<i class="k-menu__link-bullet k-menu__link-bullet--line"><span></span></i>
																<span class="k-menu__link-text">{{ __('backend/management.tickets.title') }}</span>
																<i class="k-menu__hor-arrow la la-angle-right"></i>
																<i class="k-menu__ver-arrow la la-angle-right"></i>
															</a>
															<div class="k-menu__submenu k-menu__submenu--classic k-menu__submenu--right">
																<ul class="k-menu__subnav">
																	@if(Auth::user()->hasPermission('manage_tickets'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-tickets') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.tickets.title') }}</span>
																		</a>
																	</li>
																	@endif

																	@if(Auth::user()->hasPermission('manage_tickets_categories'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-tickets-categories') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.tickets.categories.title') }}</span>
																		</a>
																	</li>
																	@endif
																</ul>
															</div>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_products') || Auth::user()->hasPermission('manage_products_categories'))
														<li class="k-menu__item k-menu__item--submenu" data-kmenu-submenu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="k-menu__link k-menu__toggle">
																<i class="k-menu__link-bullet k-menu__link-bullet--line"><span></span></i>
																<span class="k-menu__link-text">{{ __('backend/management.products.title') }}</span>
																<i class="k-menu__hor-arrow la la-angle-right"></i>
																<i class="k-menu__ver-arrow la la-angle-right"></i>
															</a>
															<div class="k-menu__submenu k-menu__submenu--classic k-menu__submenu--right">
																<ul class="k-menu__subnav">
																	@if(Auth::user()->hasPermission('manage_products'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-products') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.products.title') }}</span>
																		</a>
																	</li>
																	@endif

																	@if(Auth::user()->hasPermission('manage_products_categories'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-products-categories') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.products.categories.title') }}</span>
																		</a>
																	</li>
																	@endif
																</ul>
															</div>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_faqs') || Auth::user()->hasPermission('manage_faqs_categories'))
														<li class="k-menu__item k-menu__item--submenu" data-kmenu-submenu-toggle="hover" aria-haspopup="true">
															<a href="javascript:;" class="k-menu__link k-menu__toggle">
																<i class="k-menu__link-bullet k-menu__link-bullet--line"><span></span></i>
																<span class="k-menu__link-text">{{ __('backend/management.faqs.title') }}</span>
																<i class="k-menu__hor-arrow la la-angle-right"></i>
																<i class="k-menu__ver-arrow la la-angle-right"></i>
															</a>
															<div class="k-menu__submenu k-menu__submenu--classic k-menu__submenu--right">
																<ul class="k-menu__subnav">
																	@if(Auth::user()->hasPermission('manage_faqs'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-faqs') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.faqs.title') }}</span>
																		</a>
																	</li>
																	@endif

																	@if(Auth::user()->hasPermission('manage_faqs_categories'))
																	<li class="k-menu__item" aria-haspopup="true">
																		<a href="{{ route('backend-management-faqs-categories') }}" class="k-menu__link ">
																			<i class="k-menu__link-bullet k-menu__link-bullet--dot"><span></span></i>
																			<span class="k-menu__link-text">{{ __('backend/management.faqs.categories.title') }}</span>
																		</a>
																	</li>
																	@endif
																</ul>
															</div>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_articles'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-management-articles') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/management.articles.title') }}</span>
															</a>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_users'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-management-users') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/management.users.title') }}</span>
															</a>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_coupons'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-management-coupons') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/management.coupons.title') }}</span>
															</a>
														</li>
														@endif

														@if(Auth::user()->hasPermission('manage_delivery_methods'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-management-delivery-methods') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/management.delivery_methods.title') }}</span>
															</a>
														</li>
														@endif
													</ul>
												</div>
											</li>
											@endif
											
											@if(Auth::user()->hasAnyPermissionFromArray(['system_settings', 'system_payments']))
											<li class="k-menu__item @if(in_array(\Route::currentRouteName(), ['backend-system-settings'])) k-menu__item--here @endif k-menu__item--open k-menu__item--submenu k-menu__item--rel k-menu__item--open" data-kmenu-submenu-toggle="click" aria-haspopup="true">
												<a href="javascript:;" class="k-menu__link k-menu__toggle">
													<span class="k-menu__link-text">{{ __('backend/system.title') }}</span>
													<i class="k-menu__hor-arrow la la-angle-down"></i>
													<i class="k-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="k-menu__submenu k-menu__submenu--classic k-menu__submenu--left">
													<ul class="k-menu__subnav">
														@if(Auth::user()->hasPermission('system_settings'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-system-settings') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/system.settings.title') }}</span>
															</a>
														</li>
														@endif

														@if(Auth::user()->hasPermission('system_bonus'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-system-bonus') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																	<span></span>
																</i>
																<span class="k-menu__link-text">Bonus</span>
															</a>
														</li>
														@endif

														@if(Auth::user()->hasPermission('system_payments'))
														<li class="k-menu__item" aria-haspopup="true">
															<a href="{{ route('backend-system-payments') }}" class="k-menu__link ">
																<i class="k-menu__link-bullet k-menu__link-bullet--line">
																<span></span>
																</i>
																<span class="k-menu__link-text">{{ __('backend/system.payments.title') }}</span>
															</a>
														</li>
														@endif
													</ul>
												</div>
											</li>
											@endif
										</ul>
									</div>
									<div class="k-header-toolbar">
										<a href="{{ route('shop') }}" target="_shop" class="btn btn-wide btn-bold btn-danger btn-upper">{{ __('backend/header.go_to_shop') }}</a>
									</div>
								</div>

								<!-- end: Header Menu -->
							</div>
						</div>
					</div>

					<!-- end:: Header -->
					<div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-grid--stretch">
						<div class="k-container k-content-wrapper  k-grid k-grid--ver" id="k_content_wrapper">

							<!-- begin:: Content -->
							<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

								@if (\Session::has('errorMessage'))
									<div class="alert alert-danger fade show" role="alert">
										<div class="alert-text">
											{!! \Session::get('errorMessage') !!}
										</div>
										<div class="alert-close">
											<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
												<span aria-hidden="true"><i class="la la-close"></i></span>
											</button>
										</div>
									</div>
								@endif

								@if (\Session::has('successMessage'))
									<div class="alert alert-success fade show" role="alert">
										<div class="alert-text">
											{!! \Session::get('successMessage') !!}
										</div>
										<div class="alert-close">
											<button type="button" class="close" data-dismiss="alert" aria-label="{{ __('frontend/main.close') }}">
												<span aria-hidden="true"><i class="la la-close"></i></span>
											</button>
										</div>
									</div>
								@endif

								@section('content')

								@show
								
							</div>

							<!-- end:: Content -->
						</div>
					</div>

					<!-- begin:: Footer -->
					<div class="k-footer k-grid__item" style="background-image: url({{ asset_dir('admin/assets/files/media/layout/footer-bg.jpg') }})" id="k_footer">
						<div class="k-container">
							<div class="k-footer__bottom">
								<div class="k-footer__copyright">
									2020 &copy; <a href="#" class="k-link">OpenFraudCart</a>.
								</div>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Scrolltop -->
		<div id="k_scrolltop" class="k-scrolltop">
			<i class="la la-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- begin::Global Config -->
		<script>
			var KAppOptions = {
				"colors": {
					"state": {
						"brand": "#4d5cf2",
						"metal": "#c4c5d6",
						"light": "#ffffff",
						"accent": "#00c5dc",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995",
						"focus": "#9816f4"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin:: Global Mandatory Vendors -->
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/theme/framework/vendors/bootstrap-datepicker/init.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/theme/framework/vendors/bootstrap-timepicker/init.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/inputmask/dist/inputmask/inputmask.phone.extensions.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/theme/framework/vendors/bootstrap-markdown/init.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery-validation/dist/jquery.validate.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery-validation/dist/additional-methods.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/theme/framework/vendors/jquery-validation/init.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/custom/theme/framework/vendors/sweetalert2/init.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
		<script src="{{ asset_dir('admin/assets/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle -->
		<script src="{{ asset_dir('admin/assets/files/base/scripts.bundle.js') }}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<script src="{{ asset_dir('admin/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script type="text/javascript">
			function reloadNotifications() {
				$('#notifications-content').html('<center>{{ __('backend/main.notifications.please_wait') }}</center>');
						
				$.getJSON('{{ route('backend-api-notifications') }}', function(data) {
					$('#notifications-content').html('');

					if(data['notifications'].length > 0) {
						$.each(data['notifications'], function(index) {
							$('#notifications-content').append('\
								<a href="#" class="k-notification__item">\
									<div class="k-notification__item-icon">\
										<i class="' + data['notifications'][index].icon + '"></i>\
									</div>\
									<div class="k-notification__item-details">\
										<div class="k-notification__item-title">\
										' + data['notifications'][index].message + '\
										</div>\
										<div class="k-notification__item-time">\
										' + data['notifications'][index].datetime + '\
										</div>\
									</div>\
								</a>\
							');
						});
					} else {
						$('#notifications-content').html('<center>{{ __('backend/main.notifications.no_entries') }}</center>');
					}

					$('#notifications-count').html('0');
				});
			}

			$(document).ready(function() {
				//reloadNotifications();

				$('#dropdown-notifications div[data-toggle="dropdown"]').click(function () {
					if($(this).attr('aria-expanded') == 'false') {
						reloadNotifications();
					}
				});
			});
		</script>

		<link href="{{ asset_dir('admin/assets/froala-editor/css/froala_editor.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/froala_style.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/themes/gray.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/code_view.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/colors.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/emoticons.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/image.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/quick_insert.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset_dir('admin/assets/froala-editor/css/plugins/table.min.css') }}" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/froala_editor.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/languages/de.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/quick_insert.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/image.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/font_size.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/font_family.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/emoticons.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/colors.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/code_view.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/align.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/table.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset_dir('admin/assets/froala-editor/js/plugins/link.min.js') }}"></script>

		@section('page_scripts')

		@show
		<!--end::Page Scripts -->

		<!--begin::Global App Bundle -->
		<script src="{{ asset_dir('admin/assets/app/scripts/bundle/app.bundle.js') }}" type="text/javascript"></script>

		<!--end::Global App Bundle -->

		<!-- begin::Page Loader -->
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip();
			});

			$(window).on('load', function() {
				$('body').removeClass('k-page--loading');
			});
		</script>

		<!-- end::Page Loader -->
	</body>

	<!-- end::Body -->
</html>