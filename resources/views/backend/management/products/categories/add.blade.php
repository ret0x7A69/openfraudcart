@extends('backend.layouts.default')

@section('content')
								<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.products.categories.add.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-products') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.products.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-products-categories') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.products.categories.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
										<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">{{ __('backend/management.products.categories.add.title') }}</h3>
													</div>
												</div>
												<form method="post" class="kt-form" action="{{ route('backend-management-product-category-add-form') }}">
													@csrf
													
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="form-group">
																<label for="product_category_add_name">{{ __('backend/management.products.categories.name') }}</label>
																<input type="text" class="form-control @if($errors->has('product_category_add_name')) is-invalid @endif" id="product_category_add_name" name="product_category_add_name" placeholder="{{ __('backend/management.products.categories.name') }}" value="{{ old('product_category_add_name') }}" />

																@if($errors->has('product_category_add_name'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('product_category_add_name') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="product_category_add_slug">{{ __('backend/management.products.categories.slug') }}</label>
																<input type="text" class="form-control @if($errors->has('product_category_add_slug')) is-invalid @endif" id="product_category_add_slug" name="product_category_add_slug" placeholder="{{ __('backend/management.products.categories.slug') }}" value="{{ old('product_category_add_slug') }}" />

																@if($errors->has('product_category_add_slug'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('product_category_add_slug') }}</strong>
																	</span>
																@endif
															</div>

															<div class="form-group">
																<label for="product_category_add_keywords">{{ __('backend/management.products.categories.keywords') }}</label>
																<input type="text" class="form-control @if($errors->has('product_category_add_keywords')) is-invalid @endif" id="product_category_add_keywords" name="product_category_add_keywords" placeholder="{{ __('backend/management.products.categories.keywords') }}" value="{{ old('product_category_add_keywords') }}" />

																@if($errors->has('product_category_add_keywords'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('product_category_add_keywords') }}</strong>
																	</span>
																@endif
															</div>
															
															<div class="form-group">
																<label for="product_category_add_meta_tags_desc">{{ __('backend/management.products.categories.meta_tags_desc') }}</label>
																<input type="text" class="form-control @if($errors->has('product_category_add_meta_tags_desc')) is-invalid @endif" id="product_category_add_meta_tags_desc" name="product_category_add_meta_tags_desc" placeholder="{{ __('backend/management.products.categories.meta_tags_desc') }}" value="{{ old('product_category_add_meta_tags_desc') }}" />

																@if($errors->has('product_category_add_meta_tags_desc'))
																	<span class="invalid-feedback" style="display:block" role="alert">
																		<strong>{{ $errors->first('product_category_add_meta_tags_desc') }}</strong>
																	</span>
																@endif
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<button type="submit" class="btn btn-wide btn-bold btn-danger">{{ __('backend/management.products.categories.add.submit_button') }}</button>
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