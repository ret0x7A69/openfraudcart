@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">Bonus</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-products') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.products.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">Bonus</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">Bonus</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-product-bonus', $pID) }}">
													@csrf
													
													<input type="hidden" name="settings_bonus_ids" value="{{ $Ids }}" />
													<div class="kt-portlet__body">
														@foreach($bbs as $b)
														<div class="kt-section kt-section--first row">
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_amount_{{ $b->id }}">Min. Betrag</label>
																	<input type="text" class="form-control @if($errors->has('settings_bonus_amount_' . $b->id)) is-invalid @endif" id="settings_bonus_amount_{{ $b->id }}" name="settings_bonus_amount_{{ $b->id }}" placeholder="100" value="{{ $b->min_amount }}" />
																	
																	@if($errors->has('settings_bonus_amount_' . $b->id))
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong>{{ $errors->first('settings_bonus_amount_' . $b->id) }}</strong>
																		</span>
																	@endif
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_percent_{{ $b->id }}">Prozent</label>
																	<input type="text" class="form-control @if($errors->has('settings_bonus_percent_' . $b->id)) is-invalid @endif" id="settings_bonus_percent_{{ $b->id }}" name="settings_bonus_percent_{{ $b->id }}" placeholder="0.90" value="{{ $b->percent }}" />
																	
																	@if($errors->has('settings_bonus_percent_' . $b->id))
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong>{{ $errors->first('settings_bonus_percent_' . $b->id) }}</strong>
																		</span>
																	@endif
																</div>
															</div>
															<div class="col-md-2" style="padding-top:27px">
																
																<a href="{{ route('backend-management-product-bonus-del', [$pID, $b->id]) }}" class="btn btn-danger">Löschen</a>
															</div>
														</div>
														@endforeach
														
														<div class="kt-section kt-section--first row">
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_amount_new">Min. Betrag</label>
																	<input type="text" class="form-control @if($errors->has('settings_bonus_amount_new')) is-invalid @endif" id="settings_bonus_amount_new" name="settings_bonus_amount_new" placeholder="100" value="" />
																	
																	@if($errors->has('settings_bonus_amount_new'))
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong>{{ $errors->first('settings_bonus_amount_new') }}</strong>
																		</span>
																	@endif
																</div>
															</div>
															<div class="col-md-5">
																<div class="form-group">
																	<label for="settings_bonus_percent_new">Prozent</label>
																	<input type="text" class="form-control @if($errors->has('settings_bonus_percent_new')) is-invalid @endif" id="settings_bonus_percent_new" name="settings_bonus_percent_new" placeholder="0.90" value="" />
																	
																	@if($errors->has('settings_bonus_percent_new'))
																		<span class="invalid-feedback" style="display:block;" role="alert">
																			<strong>{{ $errors->first('settings_bonus_percent_new') }}</strong>
																		</span>
																	@endif
																</div>
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">Speichern</button>
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