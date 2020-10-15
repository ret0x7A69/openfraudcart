@extends('backend.layouts.default')

@section('content')
                            <div class="k-content__head	k-grid__item">
									<div class="k-content__head-main">
										<h3 class="k-content__head-title">{{ __('backend/management.delivery_methods.title') }}</h3>
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
											<a href="{{ route('backend-management-delivery-method-add') }}" class="btn btn-wide btn-bold btn-primary btn-upper" style="margin-bottom:15px">{{ __('backend/main.add') }}</a>

											<div class="kt-portlet">
												<div class="kt-portlet__body">
													<div class="kt-section kt-section--first">
														@if(count($deliveryMethods))
														<table class="table table-head-noborder">
															<thead>
																<tr>
																	<th>{{ __('backend/management.delivery_methods.id') }}</th>
																	<th>{{ __('backend/management.delivery_methods.name') }}</th>
																	<th>{{ __('backend/management.delivery_methods.price') }}</th>
																	<th>{{ __('backend/management.delivery_methods.date') }}</th>
																	<th>{{ __('backend/management.delivery_methods.actions') }}</th>
																</tr>
															</thead>
															<tbody>
																@foreach($deliveryMethods as $deliveryMethod)
																<tr>
																	<th scope="row">{{ $deliveryMethod->id }}</th>
																	<td>{{ $deliveryMethod->name }}</td>
																	<td>
																		{{ $deliveryMethod->getFormattedPrice() }}
																	</td>
																	<td>
																		{{ $deliveryMethod->created_at->format('d.m.Y H:i') }}
																	</td>
																	<td style="font-size: 20px;">
																		<a href="{{ route('backend-management-delivery-method-edit', $deliveryMethod->id) }}"><i class="la la-edit"></i></a>
																		<a href="{{ route('backend-management-delivery-method-delete', $deliveryMethod->id) }}"><i class="la la-trash"></i></a>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>

														{!! preg_replace('/' . $deliveryMethods->currentPage() . '\?page=/', '', $deliveryMethods->links()) !!}
														@else
														<i>{{ __('backend/main.no_entries') }}</i>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
@endsection

@section('page_scripts')

@endsection