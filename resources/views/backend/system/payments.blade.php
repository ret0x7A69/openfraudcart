@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/system.payments.title') }}</h3>
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
														<h3 class="kt-portlet__head-title">{{ __('backend/system.payments.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-system-payments-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="payments_bitcoin_api">{{ __('backend/system.payments.bitcoin_api') }}</label>
																<input type="text" class="form-control @if($errors->has('payments_bitcoin_api')) is-invalid @endif" id="payments_bitcoin_api" name="payments_bitcoin_api" placeholder="{{ __('backend/system.payments.bitcoin_api_placeholder') }}" value="" />
																
																@if($errors->has('payments_bitcoin_api'))
																	<span class="invalid-feedback" style="display:block;" role="alert">
																		<strong>{{ $errors->first('payments_bitcoin_api') }}</strong>
																	</span>
																@endif

																@if(!App\Classes\BitcoinAPI::connected())
																<span class="invalid-feedback" style="margin-top:10px;display:block;" role="alert">
																	<strong>{{ __('backend/system.payments.status') }} {{ __('backend/system.payments.failed') }}</strong>
																</span>
																@endif
																
																@if(App\Classes\BitcoinAPI::connected())
																<span class="valid-feedback" style="margin-top:10px;display:block;" role="alert">
																	<strong>{{ __('backend/system.payments.status') }} {{ __('backend/system.payments.connected') }}</strong>
																</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/system.payments.submit_button') }}</button>
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