@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.coupons.edit.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-coupons') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.coupons.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.coupons.edit.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-coupon-edit-form') }}">
													@csrf

													<input type="hidden" value="{{ $coupon->id }}" name="coupon_edit_id" />
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
														<div class="form-group">
																<label for="coupon_edit_code">{{ __('backend/management.coupons.code') }}</label>
																<input type="text" class="form-control @if($errors->has('coupon_edit_code')) is-invalid @endif" id="coupon_edit_code" name="coupon_edit_code" placeholder="{{ __('backend/management.coupons.code') }}" value="{{ $coupon->code }}" />

																@if($errors->has('coupon_edit_code'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('coupon_edit_code') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="coupon_edit_amount">{{ __('backend/management.coupons.amount') }}</label>
																<input type="number" class="form-control @if($errors->has('coupon_edit_amount')) is-invalid @endif" id="coupon_edit_amount" name="coupon_edit_amount" placeholder="{{ __('backend/management.coupons.amount') }}" value="{{ $coupon->amount }}" />

																@if($errors->has('coupon_edit_amount'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('coupon_edit_amount') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="coupon_edit_max_usable">{{ __('backend/management.coupons.max_usable') }}</label>
																<input type="number" class="form-control @if($errors->has('coupon_edit_max_usable')) is-invalid @endif" id="coupon_edit_max_usable" name="coupon_edit_max_usable" placeholder="{{ __('backend/management.coupons.max_usable') }}" value="{{ $coupon->max_usable }}" />

																@if($errors->has('coupon_edit_max_usable'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('coupon_edit_max_usable') }}</strong>
																	</span>
																@endif
															</div>
														<div class="form-group">
																<label for="coupon_edit_is_percent">
																<input type="checkbox" class="checkbox @if($errors->has('coupon_edit_is_percent')) is-invalid @endif" id="coupon_edit_is_percent" name="coupon_edit_is_percent" {{ $coupon->isPercent() ? ' checked ' : '' }} />
																Prozentual berechnen
																</label>
																

																@if($errors->has('coupon_edit_is_percent'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('coupon_edit_is_percent') }}</strong>
																	</span>
																@endif
															</div>

															<!--
															<div style="margin-bottom: 5px;">
																<b>{{ __('backend/management.coupons.edit.options') }}</b>
															</div>
															
															<div class="form-group">
																<label class="k-checkbox k-checkbox--all k-checkbox--solid">
																	<input type="checkbox" name="coupon_edit_unlimited" @if($coupon->isUnlimited()) checked @endif />
																	<span></span>
																	{{ __('backend/management.coupons.edit.unlimited') }}
																</label>
															</div>
															-->
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.coupons.edit.submit_button') }}</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')
<script type="text/javascript">
	$(function() {
		$('textarea.text-editor').froalaEditor({
			toolbarSticky: false,
			language: 'de',
      		theme: 'gray',
			toolbarButtons: ['undo', 'redo' , '|', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'align', '|', 'fontFamily', 'fontSize', 'color', '|', 'emoticons', '|', 'insertLink', 'insertImage', '|', 'outdent', 'indent', 'clearFormatting', 'insertTable', 'html']
		});
  	});
</script>
@endsection