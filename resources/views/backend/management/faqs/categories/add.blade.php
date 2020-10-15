@extends('backend.layouts.default')

@section('content')
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.faqs.categories.add.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-faqs') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.faqs.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-faqs-categories') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.faqs.categories.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.faqs.categories.add.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-faq-category-add-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="faq_category_add_name">{{ __('backend/management.faqs.categories.name') }}</label>
																<input type="text" class="form-control @if($errors->has('faq_category_add_name')) is-invalid @endif" id="faq_category_add_name" name="faq_category_add_name" placeholder="{{ __('backend/management.faqs.categories.name') }}" value="{{ old('faq_category_add_name') }}" />

																@if($errors->has('faq_category_add_name'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('faq_category_add_name') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.faqs.categories.add.submit_button') }}</button>
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