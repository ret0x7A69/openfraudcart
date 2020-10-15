@extends('backend.layouts.default')

@section('content')
                            	<div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.products.categories.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="{{ route('backend-management-products') }}" class="k-content__head-breadcrumb-link">{{ __('backend/management.products.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="{{ route('backend-management-product-category-add') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.add') }}</a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($productsCategories))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.products.categories.id') }}</th>
																	<th>{{ __('backend/management.products.categories.name') }}</th>
																	<th>{{ __('backend/management.products.categories.slug') }}</th>
																	<th>{{ __('backend/management.products.categories.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($productsCategories as $productCategory)
																<tr>
																	<th scope="row">{{ $productCategory->id }}</th>
																	<td>{{ $productCategory->name }}</td>
																	<td>{{ $productCategory->slug }}</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-management-product-category-edit', $productCategory->id) }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-product-category-delete', $productCategory->id) }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif

														{!! preg_replace('/' . $productsCategories->currentPage() . '\?page=/', '', $productsCategories->links()) !!}
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection