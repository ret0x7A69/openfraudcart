@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/jabber.title') }}</h3>
									</div>
								</div>

								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/jabber.newsletter.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="{{ route('backend-jabber-newsletter-form') }}" style="width: 100%;">
														@csrf
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_message">{{ __('backend/jabber.newsletter.message') }}</label>
															<textarea style="width: 100%;" class="form-control @if($errors->has('jabber_message')) is-invalid @endif" name="jabber_message" id="jabber_message" placeholder="{{ __('backend/jabber.newsletter.type_here') }}">{{ old('jabber_message') }}</textarea>

															@if($errors->has('jabber_message'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('jabber_message') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/jabber.newsletter.submit_button') }}" />
														</div>
													</form>
												</div>
											</div>
										</div>
										@if(Auth::user()->hasPermission('jabber_login'))
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="k-portlet k-portlet--height-fluid">
												<div class="k-portlet__head">
													<div class="k-portlet__head-label">
														<h3 class="k-portlet__head-title">{{ __('backend/jabber.login.title') }}</h3>
													</div>
												</div>
												<div class="k-portlet__body k-portlet__body--fluid">
													<form method="POST" action="{{ route('backend-jabber-login-form') }}" style="width: 100%;">
														@csrf
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_address">{{ __('backend/jabber.login.address') }}</label>
															<input style="width: 100%;" class="form-control @if($errors->has('jabber_address')) is-invalid @endif" name="jabber_address" id="jabber_address" placeholder="{{ __('backend/jabber.login.address_placeholder') }}" value="{{ App\Models\Setting::get('jabber.address') }}" />

															@if($errors->has('jabber_address'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('jabber_address') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_username">{{ __('backend/jabber.login.username') }}</label>
															<input style="width: 100%;" class="form-control @if($errors->has('jabber_username')) is-invalid @endif" name="jabber_username" id="jabber_username" placeholder="{{ __('backend/jabber.login.username') }}" value="{{ App\Models\Setting::get('jabber.username') }}" />

															@if($errors->has('jabber_username'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('jabber_username') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group" style="width: 100%;">
															<label for="jabber_password">{{ __('backend/jabber.login.password') }}</label>
															<input style="width: 100%;" class="form-control @if($errors->has('jabber_password')) is-invalid @endif" name="jabber_password" id="jabber_password" placeholder="{{ __('backend/jabber.login.password') }}" value="{{ App\Models\Setting::get('jabber.password') }}" />

															@if($errors->has('jabber_password'))
																<span class="invalid-feedback" style="display:block" role="alert">
																	<strong>{{ $errors->first('jabber_password') }}</strong>
																</span>
															@endif
														</div>
														
														<div class="form-group">
															<input type="submit" class="btn btn-wide btn-bold btn-danger" value="{{ __('backend/jabber.login.save') }}" />
														</div>
													</form>
												</div>
											</div>
										</div>
										@endif
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection