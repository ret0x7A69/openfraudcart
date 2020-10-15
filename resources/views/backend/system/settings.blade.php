@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/system.settings.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/system.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/system.settings.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-system-settings-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="settings_app_name">{{ __('backend/system.settings.app_name') }}</label>
																<input type="text" class="form-control @if($errors->has('settings_app_name')) is-invalid @endif" id="settings_app_name" name="settings_app_name" placeholder="{{ __('backend/system.settings.app_name') }}" value="{{ App\Models\Setting::get('app.name') }}" />

																@if($errors->has('settings_app_name'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('settings_app_name') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_api_enabled">{{ __('backend/system.settings.api_enabled') }}</label>
																<select name="settings_api_enabled" id="settings_api_enabled" class="form-control @if($errors->has('settings_api_enabled')) is-invalid @endif">
																	<option>{{ __('backend/system.settings.please_choose') }}</option>
																	<option value="0" @if(!App\Models\Setting::get('api.enabled')) selected @endif>{{ __('backend/system.settings.no') }}</option>
																	<option value="1" @if(App\Models\Setting::get('api.enabled')) selected @endif>{{ __('backend/system.settings.yes') }}</option>	
																</select>

																@if($errors->has('settings_api_enabled'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('settings_api_enabled') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_api_key">{{ __('backend/system.settings.api_key') }}</label>
																<input type="text" class="form-control @if($errors->has('settings_api_key')) is-invalid @endif" id="settings_api_key" name="settings_api_key" placeholder="{{ __('backend/system.settings.api_key') }}" value="@if(strlen(App\Models\Setting::get('api.key')) > 0){{ decrypt(App\Models\Setting::get('api.key')) }}@endif" />

																@if($errors->has('settings_api_key'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('settings_api_key') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_shop_currency">{{ __('backend/system.settings.shop_currency') }}</label>
																<input type="text" class="form-control @if($errors->has('settings_shop_currency')) is-invalid @endif" id="settings_shop_currency" name="settings_shop_currency" placeholder="{{ __('backend/system.settings.shop_currency') }}" value="{{ App\Models\Setting::get('shop.currency') }}" />
																
																@if($errors->has('settings_shop_currency'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('settings_shop_currency') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_bonus_percent">{{ __('backend/system.settings.shop_bonus_percent') }}</label>
																<input type="text" class="form-control @if($errors->has('settings_bonus_percent')) is-invalid @endif" id="settings_bonus_percent" name="settings_bonus_percent" placeholder="{{ __('backend/system.settings.shop_bonus_percent') }}" value="{{ App\Models\Setting::get('shop.bonus_in_percent') }}" />
																
																@if($errors->has('settings_bonus_percent'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('settings_bonus_percent') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_replace_entry">{{ __('backend/system.settings.replace_entry') }}</label>
																<select name="settings_replace_entry" id="settings_replace_entry" class="form-control @if($errors->has('settings_replace_entry')) is-invalid @endif">
																	<option value="0">{{ __('backend/system.settings.please_choose') }}</option>
																	@foreach(App\Models\FAQ::all() as $faqEntry)
																	<option value="{{ $faqEntry->id }}" @if(App\Models\Setting::get('shop.replace_rules') == $faqEntry->id) selected @endif>{{ $faqEntry->question }}</option>	
																	@endforeach
																</select>

																@if($errors->has('settings_replace_entry'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('settings_replace_entry') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="settings_access_only_for_users">{{ __('backend/system.settings.access_only_for_users') }}</label>
																<select name="settings_access_only_for_users" id="settings_access_only_for_users" class="form-control @if($errors->has('settings_access_only_for_users')) is-invalid @endif">
																	<option>{{ __('backend/system.settings.please_choose') }}</option>
																	<option value="0" @if(!App\Models\Setting::get('app.access_only_for_users')) selected @endif>{{ __('backend/system.settings.anyone') }}</option>
																	<option value="1" @if(App\Models\Setting::get('app.access_only_for_users')) selected @endif>{{ __('backend/system.settings.only_registered_users') }}</option>	
																</select>

																@if($errors->has('settings_access_only_for_users'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('settings_access_only_for_users') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="register_newsletter_checked">{{ __('backend/system.settings.register_newsletter_checked') }}</label>
																<select name="register_newsletter_checked" id="register_newsletter_checked" class="form-control @if($errors->has('register_newsletter_checked')) is-invalid @endif">
																	<option>{{ __('backend/system.settings.please_choose') }}</option>
																	<option value="0" @if(!App\Models\Setting::get('register.newsletter_enabled')) selected @endif>{{ __('backend/system.settings.no') }}</option>
																	<option value="1" @if(App\Models\Setting::get('register.newsletter_enabled')) selected @endif>{{ __('backend/system.settings.yes') }}</option>	
																</select>

																@if($errors->has('register_newsletter_checked'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('register_newsletter_checked') }}</strong>
																	</span>
																@endif
															</div>
															<div class="form-group">
																<label for="creditcards_enabled">{{ __('backend/system.settings.creditcards_enabled') }}</label>
																<select name="creditcards_enabled" id="creditcards_enabled" class="form-control @if($errors->has('creditcards_enabled')) is-invalid @endif">
																	<option>{{ __('backend/system.settings.please_choose') }}</option>
																	<option value="0" @if(!App\Models\Setting::get('shop.creditcards.enabled')) selected @endif>{{ __('backend/system.settings.no') }}</option>
																	<option value="1" @if(App\Models\Setting::get('shop.creditcards.enabled')) selected @endif>{{ __('backend/system.settings.yes') }}</option>	
																</select>

																@if($errors->has('creditcards_enabled'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('creditcards_enabled') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="app_locale">Standard Sprache</label>
																<select name="app_locale" id="app_locale" class="form-control @if($errors->has('app_locale')) is-invalid @endif">
																	<option>{{ __('backend/system.settings.please_choose') }}</option>
																	@foreach(App\Models\Setting::getAvailableLocales() as $locale)
																	<option value="{{ strtolower($locale) }}" @if(strtolower(App\Models\Setting::get('app.locale')) == strtolower($locale)) selected @endif>{{ \Lang::get('locale.name', [], $locale) }}</option>
																	@endforeach
																</select>

																@if($errors->has('app_locale'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('app_locale') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="available_locales">Verfügbare Sprachen</label>
																<input name="available_locales" id="available_locales" class="form-control @if($errors->has('available_locales')) is-invalid @endif" placeholder="Komma getrennt" value="{{ App\Models\Setting::get('app.available.locales') }}" />
																
																@if($errors->has('available_locales'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('available_locales') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/system.settings.submit_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection