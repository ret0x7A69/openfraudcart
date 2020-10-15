@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.products.title') }}</h3>
										<div class="k-content__head-breadcrumbs">
											<a href="#" class="k-content__head-breadcrumb-home"><i class="flaticon-home-2"></i></a>
											<span class="k-content__head-breadcrumb-separator"></span>
											<a href="javascript:;" class="k-content__head-breadcrumb-link">{{ __('backend/management.title') }}</a>
										</div>
									</div>
								</div>
								<div class="k-content__body	k-grid__item k-grid__item--fluid">
									<div class="row">
										<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
											<a href="{{ route('backend-management-product-add') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.add') }}</a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($products))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.products.id') }}</th>
																	<th>{{ __('backend/management.products.name') }}</th>
																	<th>{{ __('backend/management.products.category') }}</th>
																	<th>{{ __('backend/management.products.price') }}</th>
																	<th>{{ __('backend/management.products.stock_status') }}</th>
																	<th>{{ __('backend/management.products.sells') }}</th>
																	<th>{{ __('backend/management.products.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($products as $product)
																<tr>
																	<th scope="row">{{ $product->id }}</th>
																	<td>{{ $product->name }}</td>
																	<td>
																		@if($product->getCategory()->slug == 'uncategorized')
																		{{ $product->getCategory()->name }}
																		@else
																		<a href="{{ route('backend-management-product-category-edit', $product->getCategory()->id) }}">{{ $product->getCategory()->name }}</a>
																		@endif
																	</td>
																	<td>{{ $product->getFormattedPrice() }}</td>
																	<td>
																		@if($product->isUnlimited())
																			{{ __('backend/management.products.unlimited') }}
																		@elseif($product->asWeight())
																			{{ __('backend/management.products.weight_available', [
																				'weight' => $product->getWeightAvailable(),
																				'char' => $product->getWeightChar()
																			]) }}
																		@else
																			@if($product->inStock())
																				{{ $product->getStock() }}
																			@else
																				{{ __('backend/management.products.sold_out') }}
																			@endif
																		@endif
																	</td>
																	<td>
																		{{ $product->getSells() }}@if($product->asWeight()){{ $product->getWeightChar() }}@endif
																	</td>
																	<td style="font-size: 20px;">
																		@if(!$product->isUnlimited() && !$product->asWeight())
																		<a href="{{ route('backend-management-product-database', $product->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/main.tooltips.database') }}"><i class="la la-database"></i></a>
																		@endif
																		<a href="{{ route('backend-management-product-edit', $product->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/main.tooltips.edit') }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-product-delete', $product->id) }}" data-toggle="tooltip" data-original-title="{{ __('backend/main.tooltips.delete') }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif

														{!! preg_replace('/' . $products->currentPage() . '\?page=/', '', $products->links()) !!}
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection